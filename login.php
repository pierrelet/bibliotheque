<?php
require 'classes/db.php';
require 'classes/Utilisateur.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = Utilisateur::login($email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getNom();
        header('Location: dashboard.php'); 
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<h1>Se connecter</h1>
<form method="POST" action="login.php">
    <label for="email">Email :</label>
    <input type="email" name="email" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <button type="submit">Se connecter</button>
</form>

</body>
</html>
