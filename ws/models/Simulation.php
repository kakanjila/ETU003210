<?php
require_once __DIR__ . '/../db.php';

class Simulation {

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO simulations (
            montant, 
            duree_mois, 
            taux_interet, 
            taux_assurance, 
            mensualite, 
            cout_total, 
            date_simulation
        ) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $data['montant'],
            $data['duree_mois'],
            $data['taux_interet'],
            $data['taux_assurance'] ?? 0,
            $data['mensualite'],
            $data['cout_total'],
            $data['date_simulation'],
        ]);
        
        return $db->lastInsertId();
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM simulations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM simulations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}