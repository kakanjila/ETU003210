<?php
require_once __DIR__ . '/../models/Pret.php';
require_once __DIR__ . '/../models/HistoriquePret.php';
require_once __DIR__ . '/../models/Client.php';

class PretController {
    public static function getAll($returnArray = false) {
        try {
            $prets = Pret::getAll();
            return $returnArray ? $prets : Flight::json($prets);
        } catch (Exception $e) {
            error_log("Erreur dans getAll: " . $e->getMessage());
            return $returnArray ? [] : Flight::json(['error' => 'Erreur lors de la récupération des prêts'], 500);
        }
    }

    public static function getById($id, $returnArray = false) {
        try {
            $pret = Pret::getById($id);
            return $returnArray ? $pret : Flight::json($pret);
        } catch (Exception $e) {
            error_log("Erreur dans getById($id): " . $e->getMessage());
            return $returnArray ? [] : Flight::json(['error' => 'Erreur lors de la récupération du prêt'], 500);
        }
    }

    public static function getByClient($id_client, $returnArray = false) {
        try {
            $prets = Pret::getByClient($id_client);
            return $returnArray ? $prets : Flight::json($prets);
        } catch (Exception $e) {
            error_log("Erreur dans getByClient($id_client): " . $e->getMessage());
            return $returnArray ? [] : Flight::json(['error' => 'Erreur lors de la récupération des prêts du client'], 500);
        }
    }

    public static function getByStatut($statut, $returnArray = false) {
        try {
            $prets = Pret::getByStatut($statut);
            return $returnArray ? $prets : Flight::json($prets);
        } catch (Exception $e) {
            error_log("Erreur dans getByStatut($statut): " . $e->getMessage());
            return $returnArray ? [] : Flight::json(['error' => 'Erreur lors de la récupération des prêts par statut'], 500);
        }
    }

    public static function create() {
        try {
            $data = Flight::request()->data;
            $id = Pret::create($data);
            Flight::json(['message' => 'Prêt créé', 'id' => $id]);
        } catch (Exception $e) {
            error_log("Erreur dans create: " . $e->getMessage());
            Flight::json(['error' => 'Erreur lors de la création du prêt'], 500);
        }
    }

    public static function update($id) {
        try {
            $data = Flight::request()->data;
            Pret::update($id, $data);
            Flight::json(['message' => 'Prêt mis à jour']);
        } catch (Exception $e) {
            error_log("Erreur dans update($id): " . $e->getMessage());
            Flight::json(['error' => 'Erreur lors de la mise à jour du prêt'], 500);
        }
    }

    public static function updateStatut($id) {
        try {
            $data = Flight::request()->data;
            Pret::updateStatut($id, $data->statut);
            HistoriquePret::logAction($id, "Statut mis à jour à {$data->statut}");
            Flight::json(['message' => 'Statut du prêt mis à jour']);
        } catch (Exception $e) {
            error_log("Erreur dans updateStatut($id): " . $e->getMessage());
            Flight::json(['error' => 'Erreur lors de la mise à jour du statut'], 500);
        }
    }

    public static function delete($id) {
        try {
            Pret::delete($id);
            Flight::json(['message' => 'Prêt supprimé']);
        } catch (Exception $e) {
            error_log("Erreur dans delete($id): " . $e->getMessage());
            Flight::json(['error' => 'Erreur lors de la suppression du prêt'], 500);
        }
    }

    public static function calculerMensualiteClient($id_client, $returnArray = false) {
        try {
            $prets = Pret::getByClient($id_client);
            error_log("Prêts pour calculerMensualiteClient($id_client): " . json_encode($prets));
            $mensualites = [];
            
            foreach ($prets as $pret) {
                if ($pret['statut'] !== 'ACTIF') {
                    error_log("Prêt ID {$pret['id_pret']} ignoré, statut: {$pret['statut']}");
                    continue;
                }
                $capital = floatval($pret['montant']);
                $tauxAnnuel = floatval($pret['taux_interet']) / 100;
                $tauxMensuel = $tauxAnnuel / 12;
                $dureeMois = intval($pret['duree_mois']);
                
                if ($tauxMensuel > 0) {
                    $mensualite = ($capital * $tauxMensuel) / (1 - pow(1 + $tauxMensuel, -$dureeMois));
                } else {
                    $mensualite = $capital / $dureeMois;
                }
                
                $mensualites[] = [
                    'id_pret' => $pret['id_pret'],
                    'montant' => $capital,
                    'taux_interet' => floatval($pret['taux_interet']),
                    'duree_mois' => $dureeMois,
                    'mensualite' => round($mensualite, 2)
                ];
            }
            
            $result = ['id_client' => $id_client, 'mensualites' => $mensualites];
            return $returnArray ? $result : Flight::json($result);
        } catch (Exception $e) {
            error_log("Erreur dans calculerMensualiteClient($id_client): " . $e->getMessage());
            return $returnArray ? [] : Flight::json(['error' => 'Erreur lors du calcul des mensualités'], 500);
        }
    }

    public static function listerClientsMensualites($returnArray = false) {
        error_log("Début de listerClientsMensualites");
        try {
            $clients = Client::getAll();
            error_log("Clients récupérés: " . json_encode($clients));
            
            // Vérification plus robuste des clients
            if ($clients === false) {
                error_log("Client::getAll a retourné false");
                $response = ['error' => 'Erreur lors de la récupération des clients'];
                return $returnArray ? $response : Flight::json($response, 500);
            }
            
            if (!is_array($clients)) {
                error_log("Client::getAll n'a pas retourné un tableau");
                $response = ['error' => 'Format de données clients invalide'];
                return $returnArray ? $response : Flight::json($response, 500);
            }
    
            if (empty($clients)) {
                error_log("Aucun client trouvé");
                return $returnArray ? [] : Flight::json([]);
            }
    
            $result = [];
            foreach ($clients as $client) {
                if (!isset($client['id_client']) || empty($client['id_client'])) {
                    error_log("Client sans ID valide: " . json_encode($client));
                    continue;
                }
                
                $prets = Pret::getByClient($client['id_client']);
                if ($prets === false) {
                    error_log("Erreur lors de la récupération des prêts pour client {$client['id_client']}");
                    continue;
                }
                
                if (!is_array($prets)) {
                    error_log("Prêts n'est pas un tableau pour client {$client['id_client']}");
                    continue;
                }
    
                $mensualites = [];
                foreach ($prets as $pret) {
                    if (!isset($pret['statut']) || $pret['statut'] !== 'ACTIF') {
                        continue;
                    }
                    
                    // Validation des données du prêt
                    if (!isset($pret['montant']) || !isset($pret['taux_interet']) || !isset($pret['duree_mois'])) {
                        error_log("Données de prêt incomplètes: " . json_encode($pret));
                        continue;
                    }
                    
                    $capital = floatval($pret['montant']);
                    $tauxAnnuel = floatval($pret['taux_interet']) / 100;
                    $tauxMensuel = $tauxAnnuel / 12;
                    $dureeMois = intval($pret['duree_mois']);
                    
                    // Calcul de la mensualité
                    if ($tauxMensuel > 0) {
                        $mensualite = ($capital * $tauxMensuel) / (1 - pow(1 + $tauxMensuel, -$dureeMois));
                    } else {
                        $mensualite = $capital / $dureeMois;
                    }
                    
                    $mensualites[] = [
                        'id_pret' => $pret['id_pret'],
                        'montant' => $capital,
                        'taux_interet' => floatval($pret['taux_interet']),
                        'duree_mois' => $dureeMois,
                        'mensualite' => round($mensualite, 2)
                    ];
                }
                
                if (!empty($mensualites)) {
                    $result[] = [
                        'id_client' => $client['id_client'],
                        'nom_client' => $client['nom'] ?? 'Inconnu',
                        'mensualites' => $mensualites
                    ];
                }
            }
            
            error_log("Résultat final: " . json_encode($result));
            
            if (empty($result)) {
                error_log("Aucune donnée valide trouvée");
                return $returnArray ? [] : Flight::json([]);
            }
            
            return $returnArray ? $result : Flight::json($result);
        } catch (Exception $e) {
            error_log("Exception dans listerClientsMensualites: " . $e->getMessage());
            $response = ['error' => 'Erreur serveur: ' . $e->getMessage()];
            return $returnArray ? $response : Flight::json($response, 500);
        }
    }
}