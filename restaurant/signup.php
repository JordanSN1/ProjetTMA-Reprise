<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/dark-theme.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>S'inscrire</h2>
            <form action="signup_action.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" id="username" placeholder="Entrez votre nom d'utilisateur" required>

                <label for="email">E-mail :</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>

                <button type="submit" class="submit-btn">S'inscrire</button>
            </form>
            <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
        </div>
    </div>
    <script src="./js/theme.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
