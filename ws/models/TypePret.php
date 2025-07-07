<?php
require_once __DIR__ . '/../db.php';

class TypePret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM types_pret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM types_pret WHERE id_type_pret = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEtablissement($id_etablissement) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM types_pret WHERE id_etablissement = ?");
        $stmt->execute([$id_etablissement]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO types_pret (id_etablissement, nom_type, taux_interet, duree_max_mois) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data->id_etablissement, $data->nom_type, $data->taux_interet, $data->duree_max_mois]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE types_pret SET id_etablissement = ?, nom_type = ?, taux_interet = ?, duree_max_mois = ? WHERE id_type_pret = ?");
        $stmt->execute([$data->id_etablissement, $data->nom_type, $data->taux_interet, $data->duree_max_mois, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM types_pret WHERE id_type_pret = ?");
        $stmt->execute([$id]);
    }
}