<?php
require_once __DIR__ . '/../db.php';

class Pret {
    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO prets (
            id_client,
            id_type_pret,
            montant,
            taux_interet,
            duree_mois,
            date_debut,
            date_fin,
            statut
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

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

    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM prets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}