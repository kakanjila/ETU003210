<?php
require_once __DIR__ . '/../db.php';

class PaiementPret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM paiements_pret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM paiements_pret WHERE id_paiement = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByPret($id_pret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM paiements_pret WHERE id_pret = ? ORDER BY date_paiement");
        $stmt->execute([$id_pret]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO paiements_pret (id_pret, date_paiement, montant_paye, solde_restant) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data->id_pret, $data->date_paiement, $data->montant_paye, $data->solde_restant]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE paiements_pret SET id_pret = ?, date_paiement = ?, montant_paye = ?, solde_restant = ? WHERE id_paiement = ?");
        $stmt->execute([$data->id_pret, $data->date_paiement, $data->montant_paye, $data->solde_restant, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM paiements_pret WHERE id_paiement = ?");
        $stmt->execute([$id]);
    }

    public static function getTotalPaye($id_pret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT SUM(montant_paye) as total FROM paiements_pret WHERE id_pret = ?");
        $stmt->execute([$id_pret]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}