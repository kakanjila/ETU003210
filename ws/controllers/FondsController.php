<?php
require_once __DIR__ . '/../models/Fonds.php';

class FondsController {
    public static function getAll() {
        $fonds = Fonds::getAll();
        Flight::json($fonds);
    }

    public static function getById($id) {
        $fond = Fonds::getById($id);
        Flight::json($fond);
    }

    public static function getByEtablissement($id_etablissement) {
        $fonds = Fonds::getByEtablissement($id_etablissement);
        Flight::json($fonds);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = Fonds::create($data);
        Flight::json(['message' => 'Fonds créé', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        Fonds::update($id, $data);
        Flight::json(['message' => 'Fonds mis à jour']);
    }

    public static function delete($id) {
        Fonds::delete($id);
        Flight::json(['message' => 'Fonds supprimé']);
    }
}