<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error_message = '';  // Variable pour afficher le message d'erreur
if (isset($_GET['error'])) {
    $error_message = $_GET['error'];  // Récupère l'erreur envoyée dans l'URL
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/dark-theme.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Se connecter</h2>
            <?php if ($error_message): ?>
                <div class="error-message"><?= $error_message ?></div>
            <?php endif; ?>
            <form action="login_action.php" method="POST">
                <label for="email">E-mail :</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>

                <button type="submit" class="submit-btn">Se connecter</button>
            </form>
            <p>Pas de compte ? <a href="signup.php">S'inscrire</a></p>
            <p>Ou <a href="index.php" class="skip-link">continuer sans se connecter</a></p>
        </div>
    </div>
    <script src="./js/theme.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
