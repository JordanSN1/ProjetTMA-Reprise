<?php
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
        echo "<script>alert('Votre feedback a été soumis avec succès !');</script>";
    } else {
        echo "Erreur : " . mysqli_error($con);
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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page de commentaires</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include("header.php"); ?>

   <br><br><br><br>
  


    <!-- Start Feedback Form -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Votre avis nous intéresse !</h2>
                        <p>Nous accordons de l’importance à votre avis. Laissez-nous un commentaire ci-dessous.</p>
                        <form id="contactForm" method="POST" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="com_feed" name="com_feed" placeholder="Write your feedback" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note_feed">Note (1 à 5) :</label>
                                        <select class="form-control" id="note_feed" name="note_feed" required>
                                            <option value="1">1 - Très mauvais</option>
                                            <option value="2">2 - Mauvais</option>
                                            <option value="3">3 - Moyen</option>
                                            <option value="4">4 - Bon</option>
                                            <option value="5">5 - Excellent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_feed_categ">Category:</label>
                                        <select class="form-control" id="id_feed_categ" name="id_feed_categ" required>
                                            <option value="">Catégorie :</option>
                                            <?php foreach ($categories as $categorie) : ?>
                                                <option value="<?= $categorie['id_feed_categ'] ?>"><?= $categorie['type_feed_categ'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Envoyer le commentaire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                
                </div>
            </div>
        </div>
    </div>
    <!-- End Feedback Form -->
<br><br>
    <!-- Start Feedback Display -->
    <div class="container mt-5">
        <h2 class="text-center">Tous les avis</h2>
        <br>
        <?php if (!empty($feedbacks)) : ?>
            <div class="row">
                <?php foreach ($feedbacks as $feedback) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $feedback['type_feed_categ'] ?></h5>
                                <p class="card-text"><?= htmlspecialchars($feedback['com_feed']) ?></p>
                                <p class="card-text"><strong>Date:</strong> <?= $feedback['date_feed'] ?></p>
                                <p class="card-text">
                                    <strong>Note :</strong>
                                    <?php for ($i = 0; $i < $feedback['note_feed']; $i++) : ?>
                                        ⭐
                                    <?php endfor; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-center">Aucun avis disponible.</p>
        <?php endif; ?>
    </div>
    <!-- End Feedback Display -->

</body>
<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Title Box */
.all-title-box {
    background-color: #6495ED;
    padding: 20px;
    text-align: center;
}

.all-title-box h2 {
    margin: 0;
    font-size: 24px;
    color: white;
}

.all-title-box .breadcrumb {
    list-style: none;
    padding: 0;
    margin: 10px 0 0;
}

.all-title-box .breadcrumb li {
    display: inline;
    font-size: 14px;
}

.all-title-box .breadcrumb li a {
    color: white;
    text-decoration: none;
}

/* Feedback Form */
.contact-box-main {
    padding: 20px;
}

.contact-form-right {
    background: white;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 auto;
    max-width: 600px;
}

.contact-form-right h2 {
    font-size: 20px;
    color: #6495ED;
    margin-bottom: 10px;
}

.contact-form-right textarea,
.contact-form-right select,
.contact-form-right button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form-right button {
    background-color: #6495ED;
    color: white;
    border: none;
    cursor: pointer;
}

.contact-form-right button:hover {
    background-color: #4169E1;
}

/* Feedback Display */
.container {
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
}

.card {
    background: white;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.card h5 {
    font-size: 18px;
    margin: 0 0 10px;
    color: #6495ED;
}

.card p {
    font-size: 14px;
    margin: 5px 0;
}
.contact-form-right button,
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-form-right button:hover {
    transform: scale(1.05);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
}

</style>

</html>
