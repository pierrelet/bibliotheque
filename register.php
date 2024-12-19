<?php
require 'classes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $db = DB::getConnection();
    $stmt = $db->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Bibliothèque en ligne</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

<header>
    <h1>Inscription à la Bibliothèque en ligne</h1>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="register.php">S'inscrire</a>
    <a href="login.php">Se connecter</a>
    <a href="dashboard.php">Mon tableau de bord</a>
</nav>

<div class="main-content">
    <form action="register.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">S'inscrire</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Bibliothèque en ligne</p>
</footer>

</body>
</html>
