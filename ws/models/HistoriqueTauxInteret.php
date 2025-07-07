<?php
require_once __DIR__ . '/../db.php';

class HistoriqueTauxInteret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM historique_taux_interet");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_taux_interet WHERE id_historique_taux = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByTypePret($id_type_pret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_taux_interet WHERE id_type_pret = ? ORDER BY date_creation");
        $stmt->execute([$id_type_pret]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO historique_taux_interet (id_type_pret, taux_interet) VALUES (?, ?)");
        $stmt->execute([$data->id_type_pret, $data->taux_interet]);
        return $db->lastInsertId();
    }

    public static function logTauxChange($id_type_pret, $taux_interet) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO historique_taux_interet (id_type_pret, taux_interet) VALUES (?, ?)");
        $stmt->execute([$id_type_pret, $taux_interet]);
    }
}