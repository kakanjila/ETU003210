<?php
require_once __DIR__ . '/../controllers/EtablissementFinancierController.php';
require_once __DIR__ . '/../controllers/FondsController.php';
require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/TypePretController.php';
require_once __DIR__ . '/../controllers/PretController.php';
require_once __DIR__ . '/../controllers/PaiementPretController.php';
require_once __DIR__ . '/../controllers/HistoriquePretController.php';
require_once __DIR__ . '/../controllers/HistoriqueTauxInteretController.php';
// Etablissements financiers
Flight::route('GET /etablissements', ['EtablissementFinancierController', 'getAll']);
Flight::route('GET /etablissements/@id', ['EtablissementFinancierController', 'getById']);
Flight::route('POST /etablissements', ['EtablissementFinancierController', 'create']);
Flight::route('PUT /etablissements/@id', ['EtablissementFinancierController', 'update']);
Flight::route('DELETE /etablissements/@id', ['EtablissementFinancierController', 'delete']);

// Fonds
Flight::route('GET /fonds', ['FondsController', 'getAll']);
Flight::route('GET /fonds/@id', ['FondsController', 'getById']);
Flight::route('GET /etablissements/@id_etablissement/fonds', ['FondsController', 'getByEtablissement']);
Flight::route('POST /fonds', ['FondsController', 'create']);
Flight::route('PUT /fonds/@id', ['FondsController', 'update']);
Flight::route('DELETE /fonds/@id', ['FondsController', 'delete']);

// Clients
Flight::route('GET /clients', ['ClientController', 'getAll']);
Flight::route('GET /clients/@id', ['ClientController', 'getById']);
Flight::route('POST /clients', ['ClientController', 'create']);
Flight::route('POST /clients/login', ['ClientController', 'login']);
Flight::route('PUT /clients/@id', ['ClientController', 'update']);
Flight::route('PUT /clients/@id/password', ['ClientController', 'updatePassword']);
Flight::route('DELETE /clients/@id', ['ClientController', 'delete']);

// Types de prêt
Flight::route('GET /types-pret', ['TypePretController', 'getAll']);
Flight::route('GET /types-pret/@id', ['TypePretController', 'getById']);
Flight::route('GET /etablissements/@id_etablissement/types-pret', ['TypePretController', 'getByEtablissement']);
Flight::route('POST /types-pret', ['TypePretController', 'create']);
Flight::route('PUT /types-pret/@id', ['TypePretController', 'update']);
Flight::route('DELETE /types-pret/@id', ['TypePretController', 'delete']);

// Prêts
Flight::route('GET /prets', ['PretController', 'getAll']);
Flight::route('GET /prets/@id', ['PretController', 'getById']);
Flight::route('GET /clients/@id_client/prets', ['PretController', 'getByClient']);
Flight::route('GET /prets/statut/@statut', ['PretController', 'getByStatut']);
Flight::route('POST /prets', ['PretController', 'create']);
Flight::route('PUT /prets/@id', ['PretController', 'update']);
Flight::route('PUT /prets/@id/statut', ['PretController', 'updateStatut']);
Flight::route('DELETE /prets/@id', ['PretController', 'delete']);

// Paiements
Flight::route('GET /paiements', ['PaiementPretController', 'getAll']);
Flight::route('GET /paiements/@id', ['PaiementPretController', 'getById']);
Flight::route('GET /prets/@id_pret/paiements', ['PaiementPretController', 'getByPret']);
Flight::route('POST /paiements', ['PaiementPretController', 'create']);
Flight::route('PUT /paiements/@id', ['PaiementPretController', 'update']);
Flight::route('DELETE /paiements/@id', ['PaiementPretController', 'delete']);

// Historiques
Flight::route('GET /prets/@id_pret/historique', ['HistoriquePretController', 'getByPret']);
Flight::route('GET /types-pret/@id_type_pret/historique-taux', ['HistoriqueTauxInteretController', 'getByTypePret']);

// PaiementPretController
Flight::route('GET /clients/@id_client/paiements/total/@debut_mois/@debut_annee/@fin_mois/@fin_annee', ['PaiementPretController', 'getTotalPaiementsClient']);
Flight::route('GET /paiements/total/@debut_mois/@debut_annee/@fin_mois/@fin_annee', ['PaiementPretController', 'getTotalPaiementsPeriode']);

// PretController
Flight::route('GET /clients/@id_client/mensualites', ['PretController', 'calculerMensualiteClient']);
Flight::route('GET /clients/mensualites', function() {
    $result = PretController::listerClientsMensualites(true);
    Flight::json($result); 
});