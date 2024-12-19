<?php
require 'classes/db.php';
require 'classes/Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les informations du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'email est déjà pris
    $db = DB::getConnection();
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_user) {
        echo "L'email est déjà utilisé.";
    } else {
        // Enregistrer l'utilisateur
        Utilisateur::register($nom, $email, $password);
        header('Location: login.php'); // Rediriger vers la page de connexion
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

<h1>Inscription</h1>
<form method="POST" action="register.php">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
