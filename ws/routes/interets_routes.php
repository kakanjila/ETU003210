<?php
require_once __DIR__ . '/../controllers/InteretsController.php';

// Routes pour les intérêts
Flight::route('GET /interets/par-mois', ['InteretsController', 'getInteretsParMois']);
Flight::route('GET /interets/par-mois-paiements', ['InteretsController', 'getInteretsParMoisAvecPaiements']);
Flight::route('GET /interets/annuite-constante', ['InteretsController', 'getInteretsAnnuiteConstante']);
Flight::route('GET /etablissements', ['InteretsController', 'getEtablissements']);
Flight::route('GET /interets/statistiques', ['InteretsController', 'getStatistiquesGlobales']);
?> 