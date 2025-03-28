<?php
// Vérifier si la session est déjà active avant toute chose
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Enregistre le nom d'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
            header("Location: login.php?error=Mot%20de%20passe%20incorrect");
        }
    } else {
        header("Location: login.php?error=Pas%20de%20compte%20avec%20cet%20email");
    }
}
?>
