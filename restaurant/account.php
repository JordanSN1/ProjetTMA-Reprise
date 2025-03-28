<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>
    <header>
        <h1>Mon Compte</h1>
    </header>

    <main>
        <h2>Bienvenue, <?= htmlspecialchars($user['username']) ?>!</h2>
        <p>Email : <?= htmlspecialchars($user['email']) ?></p>

        <h3>Historique des commandes</h3>
        <!-- Ajouter ici un affichage des commandes si applicable -->
        <p>Vous n'avez pas encore passé de commande.</p>

        <!-- Bouton de déconnexion -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Se déconnecter</button>
        </form>
    </main>
</body>
</html>
