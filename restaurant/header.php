<?php
session_start();

include('db.php');

// Récupérer les informations de l'utilisateur connecté
$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty</title>

    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="#" class="nav__logo">Tasty</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="index.php#home" class="nav__link active-link">Accueil</a></li>
                <li class="nav__item"><a href="index.php#about" class="nav__link">À propos</a></li>
                <li class="nav__item"><a href="index.php#services" class="nav__link">Services</a></li>
                <li class="nav__item"><a href="index.php#menu" class="nav__link">Menu</a></li>
                <li class="nav__item"><a href="index.php#contact" class="nav__link">Nous contacter</a></li>

                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav__item"><a href="account.php">Bonjour, <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <?php else: ?>
                    <li class="nav__item"><a href="login.php">Se connecter</a></li>
                <?php endif; ?>

                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>
