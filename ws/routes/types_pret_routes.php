<?php
require_once __DIR__ . '/../controllers/TypesPretController.php';

// Routes pour les types de prêt
Flight::route('GET /types_pret', ['TypesPretController', 'getAll']);
Flight::route('GET /types_pret/@id', ['TypesPretController', 'get']);
Flight::route('POST /types_pret', ['TypesPretController', 'create']);
Flight::route('PUT /types_pret/@id', ['TypesPretController', 'update']);
Flight::route('DELETE /types_pret/@id', ['TypesPretController', 'delete']);
Flight::route('PUT /types_pret/@id/taux', ['TypesPretController', 'updateTaux']);
Flight::route('GET /types_pret/@id/historique-taux', ['TypesPretController', 'getHistoriqueTaux']);
