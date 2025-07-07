<?php
require_once __DIR__ . '/../models/PaiementPret.php';
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../models/HistoriquePret.php';

class PaiementPretController {
    public static function getAll() {
        $paiements = PaiementPret::getAll();
        Flight::json($paiements);
    }

    public static function getById($id) {
        $paiement = PaiementPret::getById($id);
        Flight::json($paiement);
    }

    public static function getByPret($id_pret) {
        $paiements = PaiementPret::getByPret($id_pret);
        Flight::json($paiements);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = PaiementPret::create($data);
        
        // Mettre à jour le statut du prêt si complètement payé
        $totalPaye = PaiementPret::getTotalPaye($data->id_pret);
        $pret = Pret::getById($data->id_pret);
        
        if ($totalPaye >= $pret['montant']) {
            Pret::updateStatut($data->id_pret, 'PAYE');
            HistoriquePret::logAction($data->id_pret, "Prêt entièrement payé");
        }
        
        // Log du paiement
        HistoriquePret::logAction($data->id_pret, "Paiement de {$data->montant_paye} effectué");
        
        Flight::json(['message' => 'Paiement enregistré', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        PaiementPret::update($id, $data);
        Flight::json(['message' => 'Paiement mis à jour']);
    }

    public static function delete($id) {
        PaiementPret::delete($id);
        Flight::json(['message' => 'Paiement supprimé']);
    }
}