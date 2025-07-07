<?php
require_once __DIR__ . '/../models/TypePret.php';
require_once __DIR__ . '/../helpers/Utils.php';

class TypePretController {
    public static function getAll() {
        $typesPret = TypePret::getAll();
        Flight::json($typesPret);
    }
}