<?php
require_once __DIR__ . '/../models/Simulation.php';

class SimulationController {

    public static function create() {
        $request = Flight::request()->data;
        
        $data = [
            'montant' => $request->montant,
            'duree_mois' => $request->duree_mois,
            'taux_interet' => $request->taux_interet,
            'taux_assurance' => $request->taux_assurance ?? 0,
            'mensualite' => $request->mensualite,
            'cout_total' => $request->cout_total,
            'date_simulation' => date('Y-m-d H:i:s')
        ];
        
        try {
            $id = Simulation::create($data);
            Flight::json([
                'success' => true,
                'id' => $id, 
                'message' => 'Simulation enregistrée avec succès',
                'data' => $data
            ]);
        } catch (Exception $e) {
            Flight::halt(500, json_encode([
                'success' => false,
                'error' => 'Erreur lors de la création de la simulation',
                'message' => $e->getMessage()
            ]));
        }
    }

    public static function get($id) {
        try {
            $simulation = Simulation::getById($id);
            if ($simulation) {
                Flight::json([
                    'success' => true,
                    'data' => $simulation
                ]);
            } else {
                Flight::halt(404, json_encode([
                    'success' => false,
                    'error' => 'Simulation non trouvée'
                ]));
            }
        } catch (Exception $e) {
            Flight::halt(500, json_encode([
                'success' => false,
                'error' => 'Erreur lors de la récupération de la simulation',
                'message' => $e->getMessage()
            ]));
        }
    }

        public static function getAll() {
        $s = Simulation::getAll();
        Flight::json($s);
    }

}