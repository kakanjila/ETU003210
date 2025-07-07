<?php
require_once __DIR__ . '/../models/HistoriqueTauxInteret.php';

class HistoriqueTauxInteretController {
    public static function getByTypePret($id_type_pret) {
        $historique = HistoriqueTauxInteret::getByTypePret($id_type_pret);
        Flight::json($historique);
    }
}