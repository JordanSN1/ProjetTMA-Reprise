<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données avec vérification
    $reservation_date = isset($_POST['date']) ? $_POST['date'] : null;
    $reservation_time = isset($_POST['time']) ? $_POST['time'] : null;
    $num_covers = isset($_POST['covers']) ? $_POST['covers'] : null;
    $client_name = isset($_POST['name']) ? $_POST['name'] : null;

    // Vérifiez si toutes les données requises sont présentes
    if ($reservation_date && $reservation_time && $num_covers && $client_name) {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "restaurant";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Erreur de connexion : " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        // Préparer et exécuter la requête
        $sql = "INSERT INTO reservations (reservation_date, reservation_time, num_people, client_name) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $reservation_date, $reservation_time, $num_covers, $client_name);
        header("Location: index.php");
        if ($stmt->execute()) {
            echo "Réservation enregistrée avec succès !";
        } else {
            echo "Erreur lors de l'enregistrement de la réservation : " . $stmt->error;
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
        
        // Rediriger vers index.php
        header('Location: index.php');
        exit();
    } 
}

// Connexion à la base de données pour afficher les réservations
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Récupérer les réservations
$reservation_summary = '';
if (isset($_POST['filter_date'])) {
    $filter_date = $_POST['filter_date'];
    $sql = "SELECT * FROM reservations WHERE reservation_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $filter_date);
} else {
    $sql = "SELECT * FROM reservations";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservation_summary .= "<p><strong>Nom :</strong> " . htmlspecialchars($row['client_name']) . "</p>";
        $reservation_summary .= "<p><strong>Date :</strong> " . htmlspecialchars($row['reservation_date']) . "</p>";
        $reservation_summary .= "<p><strong>Heure :</strong> " . htmlspecialchars($row['reservation_time']) . "</p>";
        $reservation_summary .= "<p><strong>Couverts :</strong> " . htmlspecialchars($row['num_people']) . "</p>";
        $reservation_summary .= "<hr>";
    }
} else {
    $reservation_summary = "Aucune réservation trouvée.";
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Table</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            background-color: #f9f9f9;
            padding-top: 30px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
        }

        .form-container, .summary-container {
            width: 48%;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #date{
            width: 95%;
        }
        #name{
            width: 95%;
        }
        #covers{
            width: 95%;
        }

        #filter_date{
            width: 95%;
        }

        #filter_date {
            width: 95%;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #tit{
            color: #1F51FF;
        }

        button:hover {
            background: #0056b3;
        }

        #reservation-summary {
            margin-top: 20px;
            padding: 15px;
            background: #f0f8ff;
            border: 1px solid #007bff;
            border-radius: 8px;
        }

        #reservation-summary p {
            margin: 5px 0;
        }
    </style>
    
</head>

<body>
<?php include("header.php"); ?>
<br><br><br><br><br><br>

    <div class="container">
        <!-- Formulaire de Réservation -->
        <div class="form-container">
        <h2 id="tit">effectuer la reservation :</h2>
            <form id="reservation-form" action="reservation.php" method="post">
                <label for="date">Date de la réservation :</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Heure de la réservation :</label>
                <select id="time" name="time" required>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                </select>

                <label for="covers">Nombre de couverts :</label>
                <input type="number" id="covers" name="covers" min="1" max="6" required>

                <label for="name">Nom du client :</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" required>

                <input type="submit" value="Réserver">
            </form>
        </div>

        <!-- Résumé des Réservations et Filtrage -->
        <div class="summary-container">
        <h2 id="tit">nos reservation du jour :</h2>
                    <form method="POST">
                <label for="filter_date">Filtrer par date :</label>
                <input type="date" id="filter_date" name="filter_date" onchange="this.form.submit()">
            </form>

            
            <div id="reservation-summary">
                <?php echo $reservation_summary; ?>
            </div>
        </div>
    </div>

</body>
</html>




