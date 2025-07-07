<?php
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../helpers/Utils.php';

class ClientController {
    public static function getAll() {
        $clients = Client::getAll();
        Flight::json($clients);
    }

    public static function getById($id) {
        $client = Client::getById($id);
        if ($client) {
            Flight::json($client);
        } else {
            Flight::halt(404, json_encode(['error' => 'Client not found']));
        }
    }
}