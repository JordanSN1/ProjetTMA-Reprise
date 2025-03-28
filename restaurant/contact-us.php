<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'restaurant';

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $com_feed = mysqli_real_escape_string($con, $_POST['com_feed']);
    $note_feed = mysqli_real_escape_string($con, $_POST['note_feed']);
    $id_feed_categ = mysqli_real_escape_string($con, $_POST['id_feed_categ']);
    $date_feed = date('Y-m-d'); // Date actuelle

    // Insertion des données dans la table `feedback`
    $sql = "INSERT INTO feedback (com_feed, note_feed, id_feed_categ, date_feed) 
            VALUES ('$com_feed', '$note_feed', '$id_feed_categ', '$date_feed')";

    if (mysqli_query($con, $sql)) {
        $success_message = "Votre feedback a été soumis avec succès !";
    } else {
        $error_message = "Erreur : " . mysqli_error($con);
    }
}

// Récupération des catégories depuis la table `feedback_categ`
$categories = [];
$result = mysqli_query($con, "SELECT id_feed_categ, type_feed_categ FROM feedback_categ");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}

// Récupération de tous les feedbacks
$feedbacks = [];
$sql_feedbacks = "
    SELECT f.com_feed, f.note_feed, f.date_feed, c.type_feed_categ 
    FROM feedback f 
    JOIN feedback_categ c ON f.id_feed_categ = c.id_feed_categ 
    ORDER BY f.date_feed DESC
";
$result_feedbacks = mysqli_query($con, $sql_feedbacks);
if ($result_feedbacks) {
    while ($row = mysqli_fetch_assoc($result_feedbacks)) {
        $feedbacks[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - Tasty</title>
    
    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/dark-theme.css">
    
    <style>
        /* Styles spécifiques pour la page de contact */
        :root {
            --main-padding: 2rem;
        }
        
        /* Correction pour la navbar */
        body {
            padding-top: var(--header-height);
        }
        
        .contact-section {
            padding: 5rem 0;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .contact-form-container {
            background-color: var(--container-color);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: var(--main-padding);
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .contact-form-container h2 {
            color: var(--first-color);
            font-size: 1.8rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .contact-form-container p {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-color);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            background-color: var(--body-color);
            color: var(--text-color);
            font-family: var(--body-font);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--first-color);
            box-shadow: 0 0 0 3px rgba(79, 148, 203, 0.1);
            outline: none;
        }
        
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--title-color);
            font-weight: 500;
        }
        
        .btn {
            background-color: var(--first-color);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-family: var(--body-font);
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn:hover {
            background-color: var(--first-color-alt);
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        .text-center {
            text-align: center;
        }
        
        /* Styles pour les avis */
        .feedback-container {
            padding: 2rem 0;
        }
        
        .feedback-container h2 {
            text-align: center;
            color: var(--title-color);
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }
        
        .feedback-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--main-padding);
        }
        
        .feedback-card {
            background-color: var(--container-color);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .feedback-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .feedback-category {
            color: var(--first-color);
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }
        
        .feedback-text {
            margin-bottom: 1rem;
            color: var(--text-color);
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .feedback-date {
            color: var(--text-color-light);
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        
        .feedback-rating {
            color: #FFD700;
            font-size: 1.2rem;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 0 var(--main-padding);
        }
        
        .section-header h1 {
            font-size: 2.5rem;
            color: var(--title-color);
            margin-bottom: 1rem;
        }
        
        .section-header p {
            color: var(--text-color);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        
        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }
        
        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            color: #F44336;
            border: 1px solid rgba(244, 67, 54, 0.2);
        }
        
        /* Responsiveness */
        @media screen and (max-width: 768px) {
            :root {
                --main-padding: 1rem;
            }
            
            .contact-form-container {
                padding: 1.5rem;
                margin: 0 var(--main-padding) 2rem;
            }
            
            .feedback-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="l-main">
        <div class="section-header">
            <h1>Contactez-nous</h1>
            <p>Votre avis est précieux. N'hésitez pas à nous faire part de vos commentaires pour nous aider à améliorer notre service.</p>
        </div>
    
        <section class="contact-section">
            <div class="contact-form-container">
                <h2>Votre avis nous intéresse !</h2>
                <p>Nous accordons une grande importance à votre opinion. Laissez-nous un commentaire ci-dessous.</p>
                
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-error">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form id="contactForm" method="POST" action="">
                    <div class="form-group">
                        <label for="com_feed">Votre commentaire</label>
                        <textarea class="form-control" id="com_feed" name="com_feed" placeholder="Partagez votre expérience avec nous..." rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="note_feed">Note (1 à 5)</label>
                        <select class="form-control" id="note_feed" name="note_feed" required>
                            <option value="1">1 - Très mauvais</option>
                            <option value="2">2 - Mauvais</option>
                            <option value="3">3 - Moyen</option>
                            <option value="4">4 - Bon</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_feed_categ">Catégorie</label>
                        <select class="form-control" id="id_feed_categ" name="id_feed_categ" required>
                            <option value="">Sélectionnez une catégorie</option>
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?= $categorie['id_feed_categ'] ?>"><?= $categorie['type_feed_categ'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <button class="btn" type="submit">Envoyer mon avis</button>
                    </div>
                </form>
            </div>
    
            <div class="feedback-container">
                <h2>Ce que disent nos clients</h2>
                
                <div class="feedback-grid">
                    <?php if (!empty($feedbacks)) : ?>
                        <?php foreach ($feedbacks as $feedback) : ?>
                            <div class="feedback-card">
                                <h3 class="feedback-category"><?= $feedback['type_feed_categ'] ?></h3>
                                <p class="feedback-text"><?= htmlspecialchars($feedback['com_feed']) ?></p>
                                <div>
                                    <p class="feedback-date"><?= date('d/m/Y', strtotime($feedback['date_feed'])) ?></p>
                                    <div class="feedback-rating">
                                        <?php for ($i = 0; $i < $feedback['note_feed']; $i++) : ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                        <?php for ($i = $feedback['note_feed']; $i < 5; $i++) : ?>
                                            <span style="color: #ddd;">★</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center">Aucun avis disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include("footer.php"); ?>

    <script src="./js/main.js"></script>
    <script src="./js/theme.js"></script>
</body>
</html>
