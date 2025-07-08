<?php
require_once __DIR__ . '/../controllers/AuthController.php';

// Routes d'authentification
Flight::route('POST /auth/login', ['AuthController', 'login']);
Flight::route('POST /auth/logout', ['AuthController', 'logout']);
Flight::route('GET /auth/check', ['AuthController', 'checkAuth']);
?> 