<?php
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../models/Fonds.php';
require_once __DIR__ . '/../models/HistoriquePret.php';

class PretController {
    public static function getAll() {
        $prets = Pret::getAll();
        Flight::json($prets);
    }

    public static function getById($id) {
        $pret = Pret::getById($id);
        Flight::json($pret);
    }

    public static function getByClient($id_client) {
        $prets = Pret::getByClient($id_client);
        Flight::json($prets);
    }

    public static function getByStatut($statut) {
        $prets = Pret::getByStatut($statut);
        Flight::json($prets);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = Pret::create($data);
        
        // Log de l'action
        HistoriquePret::logAction($id, "Demande de prêt créée", $data->id_client);
        
        Flight::json(['message' => 'Demande de prêt créée', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        Pret::update($id, $data);
        
        // Log de l'action
        HistoriquePret::logAction($id, "Prêt mis à jour");
        
        Flight::json(['message' => 'Prêt mis à jour']);
    }

    public static function updateStatut($id) {
        $data = Flight::request()->data;
        $ancienPret = Pret::getById($id);
        
        Pret::updateStatut($id, $data->statut);
        
        // Log du changement de statut
        $description = "Statut changé de {$ancienPret['statut']} à {$data->statut}";
        HistoriquePret::logAction($id, $description);
        
        // Si le prêt est approuvé, déduire le montant des fonds disponibles
        if ($data->statut == 'APPROUVE') {
            // Ici, vous devriez avoir une logique pour trouver le fonds approprié
            // Pour l'exemple, nous utilisons le premier fonds de l'établissement
            $fonds = Fonds::getByEtablissement($data->id_etablissement)[0];
            Fonds::updateMontantDisponible($fonds['id_fonds'], $data->montant);
        }
        
        Flight::json(['message' => 'Statut du prêt mis à jour']);
    }

    public static function delete($id) {
        Pret::delete($id);
        Flight::json(['message' => 'Prêt supprimé']);
    }
}