<?php
require_once __DIR__ . '/../db.php';

class HistoriquePret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM historique_pret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_pret WHERE id_historique = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByPret($id_pret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_pret WHERE id_pret = ? ORDER BY date_action");
        $stmt->execute([$id_pret]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO historique_pret (id_pret, description, id_client) VALUES (?, ?, ?)");
        $stmt->execute([$data->id_pret, $data->description, $data->id_client]);
        return $db->lastInsertId();
    }

    public static function logAction($id_pret, $description, $id_client = null) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO historique_pret (id_pret, description, id_client) VALUES (?, ?, ?)");
        $stmt->execute([$id_pret, $description, $id_client]);
    }
}