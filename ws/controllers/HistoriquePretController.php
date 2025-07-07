<?php
require_once __DIR__ . '/../models/HistoriquePret.php';

class HistoriquePretController {
    public static function getByPret($id_pret) {
        $historique = HistoriquePret::getByPret($id_pret);
        Flight::json($historique);
    }
}