<?php
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../helpers/Utils.php';

class PretController {
    public static function create() {
        $data = Flight::request()->data;
        // Validate required fields
        $requiredFields = ['id_client', 'id_type_pret', 'montant', 'taux_interet', 'duree_mois', 'date_debut', 'date_fin', 'statut'];
        foreach ($requiredFields as $field) {
            if (!isset($data->$field) || empty($data->$field)) {
                Flight::halt(400, json_encode(['error' => "Missing or empty required field: $field"]));
                return;
            }
        }

        try {
            $pretId = Pret::create($data);
            Flight::json(['message' => 'Loan created successfully', 'id_pret' => $pretId], 201);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => 'Failed to create loan: ' . $e->getMessage()]));
        }
    }

    public static function getAll() {
        $prets = Pret::getAll();
        Flight::json($prets);
    }
}