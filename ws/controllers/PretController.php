<?php
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../models/TypesPret.php';

class PretController {
    public static function getAll() {
        $prets = Pret::getAllWithDetails();
        Flight::json($prets);
    }

    public static function getById($id) {
        $pret = Pret::getByIdWithDetails($id);
        Flight::json($pret);
    }

    public static function getByClientId($clientId) {
        $prets = Pret::getByClientId($clientId);
        Flight::json($prets);
    }

    public static function create() {
        $data = Flight::request()->data;
        
        if (!isset($data->id_client) || !isset($data->id_type_pret) || !isset($data->montant) 
            || !isset($data->duree_mois)) {
            Flight::halt(400, 'Données manquantes');
        }
        
        $typePret = TypesPret::getById($data->id_type_pret);
        if (!$typePret) {
            Flight::halt(404, 'Type de prêt non trouvé');
        }
        
        $dateDebut = date('Y-m-d');
        $dateFin = date('Y-m-d', strtotime("+{$data->duree_mois} months"));
        
        $pretData = [
            'id_client' => $data->id_client,
            'id_type_pret' => $data->id_type_pret,
            'montant' => $data->montant,
            'taux_interet' => $typePret['taux_interet'],
            'duree_mois' => $data->duree_mois,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'statut' => 'EN_ATTENTE'
        ];
        
        $id = Pret::create($pretData);
        
        Pret::addToHistorique($id, "Demande de prêt créée", $data->id_client);
        
        Flight::json(['message' => 'Demande de prêt créée', 'id' => $id]);
    }

    public static function updateStatus($id) {
        // Récupérer les données brutes
        $request = Flight::request();
        
        // Récupérer les données du corps de la requête
        $statut = $request->data->statut;
        $idClient = $request->data->id_client;
        
        if (empty($statut) || empty($idClient)) {
            Flight::halt(400, json_encode(['error' => 'Données manquantes']));
            return;
        }
        
        try {
            Pret::updateStatus($id, $statut);
            Pret::addToHistorique($id, "Statut changé à: {$statut}", $idClient);
            Flight::json(['message' => 'Statut du prêt mis à jour']);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Erreur lors de la mise à jour du statut']));
        }
    }

    public static function getHistorique($pretId) {
        $historique = Pret::getHistorique($pretId);
        Flight::json($historique);
    }

    public static function createPaiement($pretId) {
        $data = Flight::request()->data;
        
        if (!isset($data->montant_paye) || !isset($data->id_client)) {
            Flight::halt(400, 'Données manquantes');
        }
        
        $pret = Pret::getById($pretId);
        if (!$pret) {
            Flight::halt(404, 'Prêt non trouvé');
        }
        
        $soldeRestant = $pret['montant'] - $data->montant_paye;
        
        $paiementData = [
            'id_pret' => $pretId,
            'date_paiement' => date('Y-m-d'),
            'montant_paye' => $data->montant_paye,
            'solde_restant' => $soldeRestant
        ];
        
        Pret::createPaiement($paiementData);
        
        if ($soldeRestant <= 0) {
            Pret::updateStatus($pretId, 'PAYE');
            Pret::addToHistorique($pretId, "Prêt entièrement payé", $data->id_client);
        } else {
            Pret::addToHistorique($pretId, "Paiement effectué: {$data->montant_paye}", $data->id_client);
        }
        
        Flight::json(['message' => 'Paiement enregistré']);
    }
}