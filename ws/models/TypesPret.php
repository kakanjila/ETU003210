<?php
require_once __DIR__ . '/../db.php';

class TypesPret {
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

    public static function getByEtablissement($idEtablissement) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM types_pret WHERE id_etablissement = ?");
        $stmt->execute([$idEtablissement]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO types_pret 
                            (id_etablissement, nom_type, taux_interet, duree_max_mois) 
                            VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['id_etablissement'],
            $data['nom_type'],
            $data['taux_interet'],
            $data['duree_max_mois']
        ]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE types_pret 
                            SET nom_type = ?, taux_interet = ?, duree_max_mois = ? 
                            WHERE id_type_pret = ?");
        $stmt->execute([
            $data['nom_type'],
            $data['taux_interet'],
            $data['duree_max_mois'],
            $id
        ]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM types_pret WHERE id_type_pret = ?");
        $stmt->execute([$id]);
    }

    public static function updateTauxInteret($idTypePret, $nouveauTaux) {
        $db = getDB();
        
        // Enregistrer l'ancien taux dans l'historique avant de le modifier
        $typePret = self::getById($idTypePret);
        if ($typePret) {
            $stmt = $db->prepare("INSERT INTO historique_taux_interet 
                                (id_type_pret, taux_interet) 
                                VALUES (?, ?)");
            $stmt->execute([$idTypePret, $typePret['taux_interet']]);
        }
        
        // Mettre à jour le taux
        $stmt = $db->prepare("UPDATE types_pret SET taux_interet = ? WHERE id_type_pret = ?");
        $stmt->execute([$nouveauTaux, $idTypePret]);
    }

    public static function getHistoriqueTaux($idTypePret) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM historique_taux_interet 
                            WHERE id_type_pret = ? 
                            ORDER BY date_creation DESC");
        $stmt->execute([$idTypePret]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}