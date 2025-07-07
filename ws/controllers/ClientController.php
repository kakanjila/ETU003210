<?php
require_once __DIR__ . '/../models/Client.php';

class ClientController {
    public static function getAll() {
        $client = Client::getAll();
        Flight::json($client);
    }

    public static function getById($id) {
        $client = Client::getById($id);
        Flight::json($client);
    }

    public static function create() {
        $data = Flight::request()->data;
        $id = Client::create($data);
        Flight::json(['message' => 'Client créé', 'id' => $id]);
    }

    public static function update($id) {
        $data = Flight::request()->data;
        Client::update($id, $data);
        Flight::json(['message' => 'Client mis à jour']);
    }

    public static function updatePassword($id) {
        $data = Flight::request()->data;
        Client::updatePassword($id, $data->newPassword);
        Flight::json(['message' => 'Mot de passe mis à jour']);
    }

    public static function delete($id) {
        Client::delete($id);
        Flight::json(['message' => 'Client supprimé']);
    }

    public static function login() {
        $data = Flight::request()->data;
        $client = Client::verifyCredentials($data->email, $data->mdp);
        
        if ($client) {
            // Générer un token JWT ou session
            Flight::json(['message' => 'Connexion réussie', 'client' => $client]);
        } else {
            Flight::json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
    }
}