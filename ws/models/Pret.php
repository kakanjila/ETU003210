<?php
require_once __DIR__ . '/../db.php';

class Pret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM prets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM prets WHERE id_pret = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByClient($id_client) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM prets WHERE id_client = ?");
        $stmt->execute([$id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByTypePret($id_type_pret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM prets WHERE id_type_pret = ?");
        $stmt->execute([$id_type_pret]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByStatut($statut) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM prets WHERE statut = ?");
        $stmt->execute([$statut]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO prets (id_client, id_type_pret, montant, taux_interet, duree_mois, date_debut, date_fin, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data->id_client, 
            $data->id_type_pret, 
            $data->montant, 
            $data->taux_interet, 
            $data->duree_mois, 
            $data->date_debut, 
            $data->date_fin, 
            $data->statut ?? 'EN_ATTENTE'
        ]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE prets SET id_client = ?, id_type_pret = ?, montant = ?, taux_interet = ?, duree_mois = ?, date_debut = ?, date_fin = ?, statut = ? WHERE id_pret = ?");
        $stmt->execute([
            $data->id_client, 
            $data->id_type_pret, 
            $data->montant, 
            $data->taux_interet, 
            $data->duree_mois, 
            $data->date_debut, 
            $data->date_fin, 
            $data->statut, 
            $id
        ]);
    }

    public static function updateStatut($id, $statut) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE prets SET statut = ? WHERE id_pret = ?");
        $stmt->execute([$statut, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM prets WHERE id_pret = ?");
        $stmt->execute([$id]);
    }
}