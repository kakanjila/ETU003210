<?php
require_once __DIR__ . '/../controllers/TypesPretController.php';

Flight::route('GET /types_pret', ['TypesPretController', 'getAll']);