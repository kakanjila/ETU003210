<?php
require_once __DIR__ . '/../models/TypesPret.php';

class TypesPretController {
    public static function getAll() {
        $types = TypesPret::getAll();
        Flight::json($types);
    }
}