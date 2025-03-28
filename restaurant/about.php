<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("header.php"); ?>

    <!-- Section À propos -->
    <section class="about-section">
        <div class="about-container">
            <div class="about-text">
                <h1>À propos de nous</h1>
                <p>
                    Découvrez les saveurs authentiques de l'Afrique du Nord dans un cadre chaleureux et accueillant. 
                    Nous vous proposons des plats traditionnels marocains, tunisiens et algériens, préparés avec soin et passion.
                </p>
                <p>
                    Que ce soit un tajine savoureux, un couscous parfumé ou une pâtisserie délicieuse, chaque plat reflète 
                    notre engagement envers la qualité et la tradition.
                </p>
                <p>
                    Venez partager un moment unique avec nous, où chaque bouchée est une découverte.
                </p>
                <a href="#contact" class="btn">Contactez-nous</a>
            </div>
            <div class="about-image">
                <img src="apropos.webp" alt="Plat délicieux" class="home__img">
            </div>
        </div>
    </section>
    
    <!-- Titre de la section des créateurs -->
    <h2 class="team-title">Les créateurs</h2>
    
    <!-- Section des trois pays -->
    <section class="team-section">
        <div class="team-container">
            <!-- Maroc -->
            <div class="team-card">
                <img src="MAR.jpeg" alt="Maroc" class="team-img">
                <h2>Maroc</h2>
                <p>Hajar</p>
            </div>
            <!-- Tunisie -->
            <div class="team-card">
                <img src="TUN.jpeg" alt="Tunisie" class="team-img">
                <h2>Tunisie</h2>
                <p>Aedh, Nassim, Hela</p>
            </div>
            <!-- Algérie -->
            <div class="team-card">
                <img src="ALG.jpeg" alt="Algérie" class="team-img">
                <h2>Algérie</h2>
                <p>Faycal</p>
            </div>
        </div>
    </section>
</body>
<style>
/* Styles combinés */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: white;
    padding-top: 50px;
}

.about-section {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 20px;
    background: #fff;
}

.about-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 1200px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}

.about-text {
    padding: 40px;
    line-height: 1.8;
}

.about-text h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 20px;
}

.about-text p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 15px;
}

.about-image {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.about-image img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 10px;
}

.btn {
    padding: 10px 20px;
    background: #6495ED;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}

.btn:hover {
    background: #ADD8E6;
}

/* Styles pour la section des trois pays */
.team-section {
    background: #fff;
    padding: 40px 20px;
    text-align: center;
}

.team-title {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.team-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.team-card {
    text-align: center;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
}

.team-card:hover {
    transform: scale(1.05); /* Agrandir légèrement le profil */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Augmenter l'ombre */
    background-color: #f0f0f0; /* Changer la couleur de fond */
}

.team-card img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.team-card h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.team-card p {
    font-size: 1rem;
    color: #555;
}
</style>
</html>
