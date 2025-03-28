<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Tasty</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/account.css">
    <link rel="stylesheet" href="styles/dark-theme.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="account-container">
        <div class="account-header">
            <h1>Mon Compte</h1>
        </div>

        <div class="account-info">
            <h2>Informations personnelles</h2>
            <div class="info-item">
                <span class="info-label">Nom d'utilisateur :</span>
                <span class="info-value"><?= htmlspecialchars($user['username']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Email :</span>
                <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
            </div>
        </div>

        <div class="orders-section">
            <h3>Historique des commandes</h3>
            <div class="no-orders">
                <p>Vous n'avez pas encore passé de commande.</p>
            </div>
        </div>

        <form action="logout.php" method="POST" class="logout-form">
            <button type="submit" class="logout-btn">Se déconnecter</button>
        </form>
    </div>
    <script src="js/theme.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
