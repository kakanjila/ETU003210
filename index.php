<?php
// Redirection automatique vers la page appropriée
$user = $_COOKIE['user'] ?? null;

if ($user) {
    // L'utilisateur est connecté, rediriger vers l'application
    header('Location: index.html');
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: login.html');
}
exit;
?> 