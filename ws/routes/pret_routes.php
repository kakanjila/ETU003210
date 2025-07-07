<?php

require_once __DIR__ . '/../controllers/PretController.php';
require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/TypePretController.php';



// API routes
Flight::route('POST /prets', ['PretController', 'create']);
Flight::route('GET /types_pret', ['TypePretController', 'getAll']);
Flight::route('GET /clients', ['ClientController', 'getAll']);
Flight::route('GET /prets', ['PretController', 'getAll']);
Flight::route('GET /clients/@id', ['ClientController', 'getById']);


?>