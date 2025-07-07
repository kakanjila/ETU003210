<?php
require_once __DIR__ . '/../models/Interets.php';

class InteretsController {
    
    /**
     * Récupère les intérêts par mois
     */
    public static function getInteretsParMois() {
        $data = Flight::request()->query;
        
        $dateDebut = isset($data->date_debut) ? $data->date_debut : date('Y-m-01');
        $dateFin = isset($data->date_fin) ? $data->date_fin : date('Y-m-t');
        $idEtablissement = isset($data->id_etablissement) ? $data->id_etablissement : null;
        
        try {
            $interets = Interets::getInteretsParMois($dateDebut, $dateFin, $idEtablissement);
            Flight::json($interets);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
    
    /**
     * Récupère les intérêts par mois basés sur les paiements
     */
    public static function getInteretsParMoisAvecPaiements() {
        $data = Flight::request()->query;
        
        $dateDebut = isset($data->date_debut) ? $data->date_debut : date('Y-m-01');
        $dateFin = isset($data->date_fin) ? $data->date_fin : date('Y-m-t');
        $idEtablissement = isset($data->id_etablissement) ? $data->id_etablissement : null;
        
        try {
            $interets = Interets::getInteretsParMoisAvecPaiements($dateDebut, $dateFin, $idEtablissement);
            Flight::json($interets);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
    
    /**
     * Récupère les intérêts avec la formule de l'annuité constante
     */
    public static function getInteretsAnnuiteConstante() {
        $data = Flight::request()->query;
        
        $dateDebut = isset($data->date_debut) ? $data->date_debut : date('Y-m-01');
        $dateFin = isset($data->date_fin) ? $data->date_fin : date('Y-m-t');
        $idEtablissement = isset($data->id_etablissement) ? $data->id_etablissement : null;
        
        try {
            $interets = Interets::getInteretsAnnuiteConstante($dateDebut, $dateFin, $idEtablissement);
            Flight::json($interets);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
    
    /**
     * Récupère tous les établissements financiers
     */
    public static function getEtablissements() {
        try {
            $etablissements = Interets::getEtablissements();
            Flight::json($etablissements);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
    
    /**
     * Récupère les statistiques globales
     */
    public static function getStatistiquesGlobales() {
        $data = Flight::request()->query;
        
        $dateDebut = isset($data->date_debut) ? $data->date_debut : date('Y-m-01');
        $dateFin = isset($data->date_fin) ? $data->date_fin : date('Y-m-t');
        $idEtablissement = isset($data->id_etablissement) ? $data->id_etablissement : null;
        
        try {
            $stats = Interets::getStatistiquesGlobales($dateDebut, $dateFin, $idEtablissement);
            Flight::json($stats);
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
}
?> 