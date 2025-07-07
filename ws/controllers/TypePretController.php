<?php
require_once __DIR__ . '/../models/TypePret.php';
require_once __DIR__ . '/../models/HistoriqueTauxInteret.php';

class TypePretController {
    public static function getAll() {
        $types = TypePret::getAll();
        Flight::json($types);
    }

    public static function getById($id) {
        $type = TypePret::getById($id);
        Flight::json($type);
    }

    public static function getByEtablissement($id_etablissement) {
        $types = TypePret::getByEtablissement($id_etablissement);
        Flight::json($types);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = TypePret::create($data);
        
        // Enregistrer le taux initial dans l'historique
        HistoriqueTauxInteret::logTauxChange($id, $data->taux_interet);
        
        Flight::json(['message' => 'Type de prêt créé', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        
        // Vérifier si le taux a changé
        $ancienType = TypePret::getById($id);
        if ($ancienType['taux_interet'] != $data->taux_interet) {
            HistoriqueTauxInteret::logTauxChange($id, $data->taux_interet);
        }
        
        TypePret::update($id, $data);
        Flight::json(['message' => 'Type de prêt mis à jour']);
    }

    public static function delete($id) {
        TypePret::delete($id);
        Flight::json(['message' => 'Type de prêt supprimé']);
    }
}