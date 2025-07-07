<?php
require_once __DIR__ . '/../db.php';

class Pret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM prets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllWithDetails() {
        $db = getDB();
        $query = "SELECT p.*, c.nom as client_nom, c.email as client_email, 
                 tp.nom_type as type_pret_nom, tp.taux_interet as taux_interet_type
                 FROM prets p
                 JOIN clients c ON p.id_client = c.id_client
                 JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM prets WHERE id_pret = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByIdWithDetails($id) {
        $db = getDB();
        $query = "SELECT p.*, c.nom as client_nom, c.email as client_email, 
                 tp.nom_type as type_pret_nom, tp.taux_interet as taux_interet_type
                 FROM prets p
                 JOIN clients c ON p.id_client = c.id_client
                 JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
                 WHERE p.id_pret = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByClientId($clientId) {
        $db = getDB();
        $query = "SELECT p.*, tp.nom_type as type_pret_nom
                 FROM prets p
                 JOIN types_pret tp ON p.id_type_pret = tp.id_type_pret
                 WHERE p.id_client = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO prets 
                            (id_client, id_type_pret, montant, taux_interet, duree_mois, date_debut, date_fin, statut) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id_client'], 
            $data['id_type_pret'], 
            $data['montant'], 
            $data['taux_interet'], 
            $data['duree_mois'],
            $data['date_debut'],
            $data['date_fin'],
            $data['statut']
        ]);
        return $db->lastInsertId();
    }

    public static function updateStatus($id, $statut) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE prets SET statut = ? WHERE id_pret = ?");
        $stmt->execute([$statut, $id]);
    }

    public static function addToHistorique($idPret, $description, $idClient) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO historique_pret 
                            (id_pret, description, id_client) 
                            VALUES (?, ?, ?)");
        $stmt->execute([$idPret, $description, $idClient]);
    }

    public static function getHistorique($pretId) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_pret WHERE id_pret = ? ORDER BY date_action DESC");
        $stmt->execute([$pretId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createPaiement($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO paiements_pret 
                            (id_pret, date_paiement, montant_paye, solde_restant) 
                            VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['id_pret'],
            $data['date_paiement'],
            $data['montant_paye'],
            $data['solde_restant']
        ]);
    }

    public static function getPaiements($pretId) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM paiements_pret WHERE id_pret = ? ORDER BY date_paiement");
        $stmt->execute([$pretId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}