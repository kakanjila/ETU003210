<?php
require_once __DIR__ . '/../models/EtablissementFinancier.php';

class EtablissementFinancierController {
    public static function getAll() {
        $etablissements = EtablissementFinancier::getAll();
        Flight::json($etablissements);
    }

    public static function getById($id) {
        $etablissement = EtablissementFinancier::getById($id);
        Flight::json($etablissement);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = EtablissementFinancier::create($data);
        Flight::json(['message' => 'Établissement financier créé', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        EtablissementFinancier::update($id, $data);
        Flight::json(['message' => 'Établissement financier mis à jour']);
    }

    public static function delete($id) {
        EtablissementFinancier::delete($id);
        Flight::json(['message' => 'Établissement financier supprimé']);
    }
}