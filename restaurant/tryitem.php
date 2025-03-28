<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maghreb Délices</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <h1 class="logo">Maghreb Délices</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Accueil</a></li>
                    <li><a href="#special">Spécialités</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <a href="#reservation" class="btn-reserve">Réservez</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h2>Découvrez les saveurs authentiques du Maghreb</h2>
            <p>Un mélange parfait de traditions culinaires de Tunisie, Algérie et Maroc.</p>
            <a href="#menu" class="btn-main">Explorez notre Menu</a>
        </div>
    </section>

    <!-- Specialities Section -->
    <section id="special" class="special">
        <div class="container">
            <h2 class="section-title">Nos Spécialités</h2>
            <div class="special-items">
                <div class="special-item">
                    <img src="https://cdn.pixabay.com/photo/2016/08/04/19/40/couscous-1578253_1280.jpg" alt="Couscous Royal">
                    <h3>Couscous Royal</h3>
                    <p>Semoule fine, légumes et viandes savoureuses.</p>
                </div>
                <div class="special-item">
                    <img src="https://cdn.pixabay.com/photo/2020/07/06/09/56/tagine-5377695_1280.jpg" alt="Tagine Marocain">
                    <h3>Tagine Marocain</h3>
                    <p>Un mélange délicat de viande et fruits secs.</p>
                </div>
                <div class="special-item">
                    <img src="https://cdn.pixabay.com/photo/2020/04/22/14/29/brik-5078555_1280.jpg" alt="Brik à l'œuf">
                    <h3>Brik à l'œuf</h3>
                    <p>Feuille croustillante farcie d'un œuf et de thon.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <p>Contactez-nous : contact@maghreb-delices.com | +33 1 23 45 67 89</p>
            <p>Suivez-nous sur les réseaux sociaux !</p>
        </div>
    </footer>
</body>
<style>/* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: #fafafa;
    line-height: 1.6;
}

/* Navbar */
.navbar {
    background: #222;
    color: #fff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar .logo {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
}

.btn-reserve {
    background: #d35400;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

/* Hero Section */
.hero {
    background: url('https://cdn.pixabay.com/photo/2021/06/16/13/12/restaurant-6338974_1280.jpg') no-repeat center center/cover;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
}

.hero-content {
    max-width: 600px;
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
}

.btn-main {
    background: #d35400;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

/* Specialities Section */
.special {
    padding: 50px 20px;
    background: #f5f5f5;
    text-align: center;
}

.special-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    margin-bottom: 30px;
}

.special-items {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.special-item {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 300px;
}

.special-item img {
    width: 100%;
    border-radius: 10px;
}

.special-item h3 {
    margin: 10px 0;
}

/* Footer */
.footer {
    background: #222;
    color: #fff;
    padding: 20px;
    text-align: center;
}
</style>
</html>
