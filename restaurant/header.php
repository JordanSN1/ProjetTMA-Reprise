<?php
// Vérifiez si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclusion du fichier de connexion à la BDD après le démarrage de la session
include('db.php');

// Déterminer la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);

// Récupérer les informations de l'utilisateur connecté
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}
?>

<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="index.php" class="nav__logo">Tasty</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="index.php#home" class="nav__link <?php echo ($current_page == 'index.php') ? 'active-link' : ''; ?>">Accueil</a></li>
                <li class="nav__item"><a href="index.php#about" class="nav__link">À propos</a></li>
                <li class="nav__item"><a href="index.php#services" class="nav__link">Services</a></li>
                <li class="nav__item"><a href="index.php#menu" class="nav__link">Menu</a></li>
                <li class="nav__item"><a href="contact-us.php" class="nav__link <?php echo ($current_page == 'contact-us.php') ? 'active-link' : ''; ?>">Nous contacter</a></li>

                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav__item"><a href="account.php" class="nav__link <?php echo ($current_page == 'account.php') ? 'active-link' : ''; ?>">Bonjour, <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <?php else: ?>
                    <li class="nav__item"><a href="login.php" class="nav__link <?php echo ($current_page == 'login.php') ? 'active-link' : ''; ?>">Se connecter</a></li>
                <?php endif; ?>

                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>
