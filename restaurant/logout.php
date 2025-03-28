<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_destroy(); // Détruit toutes les sessions
header("Location: index.php"); // Redirige vers la page d'accueil
exit();
?>
