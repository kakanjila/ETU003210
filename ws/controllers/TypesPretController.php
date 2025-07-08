<?php
require_once __DIR__ . '/../models/TypesPret.php';

class TypesPretController {
    public static function getAll() {
        $types = TypesPret::getAll();
        Flight::json($types);
    }
    
    public static function get($id) {
        $type = TypesPret::getById($id);
        if ($type) {
            Flight::json($type);
        } else {
            Flight::halt(404, json_encode(['error' => 'Type de prêt non trouvé']));
        }
    }
    
    public static function create() {
        $data = [
            'id_etablissement' => 2,
            'nom_type' => Flight::request()->data->nom_type,
            'taux_interet' => Flight::request()->data->taux_interet,
            'duree_max_mois' => Flight::request()->data->duree_max_mois
        ];
        
        try {
            $id = TypesPret::create($data);
            Flight::json(['id' => $id, 'message' => 'Type de prêt créé avec succès']);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Erreur lors de la création du type de prêt']));
        }
    }
    
    public static function update($id) {
        $data = [
            'nom_type' => Flight::request()->data->nom_type,
            'taux_interet' => Flight::request()->data->taux_interet,
            'duree_max_mois' => Flight::request()->data->duree_max_mois
        ];
        
        try {
            TypesPret::update($id, $data);
            Flight::json(['message' => 'Type de prêt mis à jour avec succès']);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Erreur lors de la mise à jour du type de prêt']));
        }
    }
    
    public static function delete($id) {
        try {
            TypesPret::delete($id);
            Flight::json(['message' => 'Type de prêt supprimé avec succès']);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Erreur lors de la suppression du type de prêt']));
        }
    }
    
    public static function updateTaux($id) {
        $nouveauTaux = Flight::request()->data->taux_interet;
        
        try {
            TypesPret::updateTauxInteret($id, $nouveauTaux);
            Flight::json(['message' => 'Taux d\'intérêt mis à jour avec succès']);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Erreur lors de la mise à jour du taux d\'intérêt']));
        }
    }
    
    public static function getHistoriqueTaux($id) {
        $historique = TypesPret::getHistoriqueTaux($id);
        Flight::json($historique);
    }
}
