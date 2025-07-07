<?php
require_once __DIR__ . '/../db.php';

class TypePret {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM types_pret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}