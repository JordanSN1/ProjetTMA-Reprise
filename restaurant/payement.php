<?php
// Configuration de la connexion à la base de données
$user = 'root'; // utilisateur par défaut pour XAMPP/WAMP
$pwd = ''; // mot de passe, souvent vide en local
$db = "mysql:host=localhost;dbname=restaurant";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si tous les champs sont remplis
    if (isset($_POST["cardnumber"]) && !empty($_POST["cardnumber"]) &&
        isset($_POST["cardname"]) && !empty($_POST["cardname"]) &&
        isset($_POST["cvv"]) && !empty($_POST["cvv"]) &&
        isset($_POST["exp_month"]) && !empty($_POST["exp_month"]) &&
        isset($_POST["exp_year"]) && !empty($_POST["exp_year"])) {

        try {
            // Connexion à la base de données
            $cx = new PDO($db, $user, $pwd);
            $cx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation des données
            $ordernumber = uniqid(); // Génère un numéro unique pour chaque commande
            $cardnumber = $_POST['cardnumber'];
            $cardname = $_POST['cardname'];
            $cvv = $_POST['cvv'];
            $exp_month = $_POST['exp_month'];
            $exp_year = $_POST['exp_year'];

            // Requête SQL pour insérer les données
            $sql = "INSERT INTO transictions (ordernumber, cardnumber, cardname, cvv, exp_month, exp_year) 
                    VALUES (:ordernumber, :cardnumber, :cardname, :cvv, :exp_month, :exp_year)";
            $stmt = $cx->prepare($sql);
            $stmt->execute([
                ':ordernumber' => $ordernumber,
                ':cardnumber' => $cardnumber,
                ':cardname' => $cardname,
                ':cvv' => $cvv,
                ':exp_month' => $exp_month,
                ':exp_year' => $exp_year,
            ]);
           
            header("Location: index.php");
            exit();



        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement : " . $e->getMessage();
            die();
        }
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IR=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiment</title>
    <link rel="stylesheet" href="styling.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
<?php include("header.php"); ?>

<form action="payement.php" method="post">
<br><br><br><br><br><br><br><br><br><br><br><br>
        <div id="page" class="site">
            <div class="container">
                <div class="outer">
                    <header>
                        <div class="logo">
                            <a href="#"><strong>.web</strong>Payer</a>
                        </div>
                        <div class="time-left">
                            <time datetime="" id="time">03:00</time>
                            <span>Temps Restant</span>
                        </div>
                    </header>
                    <section class="payment">
                        <div class="left">
                            <div class="card-number">
                                <p>Numéro de carte</p>
                                <span>Saisissez le numéro de carte à 16 chiffres</span>
                                <div class="card-number-box">
                                    <input type="text" name="cardnumber" id="credit-card" autocomplete="off" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                                </div>
                            </div>
                            <div class="card-holder">
                                <div class="text">
                                    <p>Nom du titulaire de la carte</p>
                                    <span>Entrez le nom indiqué sur la carte</span>
                                </div>
                                <div class="input">
                                    <input type="text" name="cardname" id="card-name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="card-cvv">
                                <div class="text">
                                    <p>Numéro CVV</p>
                                    <span>Saisissez le numéro à 3 ou 4 chiffres figurant sur la carte</span>
                                </div>
                                <div class="input">
                                    <input type="number" name="cvv" data-maxlength="4" required oninput="this.value=this.value.slice(0,this.dataset.maxlength)">
                                </div>
                            </div>
                            <div class="card-expiration">
                                <div class="text">
                                    <p>Date d’expiration</p>
                                    <span>Entrez la date d’expiration</span>
                                </div>
                                <div class="input">
                                    <input type="number" name="exp_month" id="exp-month" placeholder="MM" data-maxlength="2" required oninput="this.value=this.value.slice(0,this.dataset.maxlength)">
                                    <strong>/</strong>
                                    <input type="number" name="exp_year" id="exp-year" placeholder="YY" data-maxlength="2" required oninput="this.value=this.value.slice(0,this.dataset.maxlength)">
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Payer">
                        </div>
                        <div class="right">
                            <div class="card-virtual">
                                <p class="cc-logo"></p>
                                <p class="name-holder"></p>
                                <p class="chip"></p>
                                <p class="highlight">
                                    <span class="last-digital" id="card-number">.... .... .... 4567</span>
                                    <span class="expiry">
                                        <span class="exp-month">--</span> /
                                        <span class="exp-year">--</span>
                                    </span>
                                </p>
                            </div>
                            <div class="receipt">
                                <ul>
                                    <li>
                                        <span>Numéro de commande</span>
                                        <span>245</span>
                                    </li>
                                    <li>
                                        <span>Produits</span>
                                        <span>$12.00</span>
                                    </li>
                                </ul>
                                <div class="total">
                                    <p class="price"><strong>$12.00</strong> Euro</p>
                                    <p>Total à Payer</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </form>
                    </div>
                    
                </section>
            </div>
        </div>
    </div>
    </form>

    <script src="script.js"></script>
</body>
</html>