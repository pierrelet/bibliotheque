<?php
require 'classes/db.php';

$db = DB::getConnection();
$query = $db->query("SELECT * FROM livres");
$livres = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en ligne</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

<header>
    <h1>Bienvenue dans notre Bibliothèque en ligne</h1>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="register.php">S'inscrire</a>
    <a href="login.php">Se connecter</a>
    <a href="dashboard.php">Mon tableau de bord</a>
</nav>

<div class="main-content">
    <div class="book-list">
        <!-- Exemple de livre -->
        <div class="book-item">
            <h3>1984</h3>
            <p>Par George Orwell</p>
            <a href="#" class="btn">Ajouter aux favoris</a>
        </div>

        <div class="book-item">
            <h3>Le Petit Prince</h3>
            <p>Par Antoine de Saint-Exupéry</p>
            <a href="#" class="btn">Ajouter aux favoris</a>
        </div>

        <!-- Vous ajouterez d'autres livres ici -->
    </div>
</div>

<footer>
    <p>&copy; 2024 Bibliothèque en ligne</p>
</footer>

</body>
</html>
