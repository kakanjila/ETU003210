<?php
require_once __DIR__ . '/../db.php';

class Fonds {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM fonds");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM fonds WHERE id_fonds = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEtablissement($id_etablissement) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM fonds WHERE id_etablissement = ?");
        $stmt->execute([$id_etablissement]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO fonds (id_etablissement, nom_fonds, montant_total, montant_disponible) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data->id_etablissement, $data->nom_fonds, $data->montant_total, $data->montant_disponible]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE fonds SET id_etablissement = ?, nom_fonds = ?, montant_total = ?, montant_disponible = ? WHERE id_fonds = ?");
        $stmt->execute([$data->id_etablissement, $data->nom_fonds, $data->montant_total, $data->montant_disponible, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM fonds WHERE id_fonds = ?");
        $stmt->execute([$id]);
    }

    public static function updateMontantDisponible($id_fonds, $montant) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE fonds SET montant_disponible = montant_disponible - ? WHERE id_fonds = ?");
        $stmt->execute([$montant, $id_fonds]);
    }
}