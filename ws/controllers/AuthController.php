<?php
require_once __DIR__ . '/../models/Client.php';

class AuthController {
    
    /**
     * Authentification d'un utilisateur
     */
    public static function login() {
        $data = Flight::request()->data;
        
        if (!isset($data->email) || !isset($data->password)) {
            Flight::halt(400, json_encode([
                'success' => false,
                'message' => 'Email et mot de passe requis'
            ]));
        }
        
        $email = trim($data->email);
        $password = trim($data->password);
        
        if (empty($email) || empty($password)) {
            Flight::halt(400, json_encode([
                'success' => false,
                'message' => 'Email et mot de passe ne peuvent pas être vides'
            ]));
        }
        
        try {
            $client = Client::getByEmail($email);
            
            if (!$client) {
                Flight::halt(401, json_encode([
                    'success' => false,
                    'message' => 'Email ou mot de passe incorrect'
                ]));
            }
            
            // Vérifier le mot de passe
            if ($client['mdp'] !== $password) {
                Flight::halt(401, json_encode([
                    'success' => false,
                    'message' => 'Email ou mot de passe incorrect'
                ]));
            }
            
            // Connexion réussie
            $userData = [
                'id_client' => $client['id_client'],
                'nom' => $client['nom'],
                'email' => $client['email'],
                'telephone' => $client['telephone'],
                'date_naissance' => $client['date_naissance']
            ];
            
            Flight::json([
                'success' => true,
                'message' => 'Connexion réussie',
                'user' => $userData
            ]);
            
        } catch (Exception $e) {
            Flight::halt(500, json_encode([
                'success' => false,
                'message' => 'Erreur interne du serveur'
            ]));
        }
    }
    
    /**
     * Déconnexion d'un utilisateur
     */
    public static function logout() {
        Flight::json([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
    
    /**
     * Vérifier si l'utilisateur est connecté
     */
    public static function checkAuth() {
        $headers = Flight::request()->headers;
        $authToken = $headers['Authorization'] ?? null;
        
        if (!$authToken) {
            Flight::halt(401, json_encode([
                'success' => false,
                'message' => 'Token d\'authentification manquant'
            ]));
        }
        
        // Pour cette version simple, on vérifie juste que le token existe
        // En production, il faudrait vérifier la validité du token
        Flight::json([
            'success' => true,
            'message' => 'Utilisateur authentifié'
        ]);
    }
}
?> 