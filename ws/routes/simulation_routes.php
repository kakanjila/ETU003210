<?php
require_once __DIR__ . '/../controllers/SimulationController.php';

// Routes pour les simulations

Flight::route('POST /simulation', ['SimulationController', 'create']);
    Flight::route('GET /simulation', ['SimulationController', 'getAll']);


