<?php
require_once __DIR__ . '/../controllers/PretController.php';

Flight::route('GET /prets', ['PretController', 'getAll']);
Flight::route('GET /prets/@id', ['PretController', 'getById']);
Flight::route('GET /clients/@clientId/prets', ['PretController', 'getByClientId']);
Flight::route('POST /prets', ['PretController', 'create']);
Flight::route('POST /prets/@id/status', ['PretController', 'updateStatus']);
Flight::route('GET /prets/@id/historique', ['PretController', 'getHistorique']);
Flight::route('POST /prets/@id/paiements', ['PretController', 'createPaiement']);
