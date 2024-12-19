<?php
require 'classes/db.php';
require 'classes/Favoris.php';
require 'classes/Livre.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Rediriger si l'utilisateur n'est pas connecté
    exit();
}

// Récupérer l'utilisateur connecté
$utilisateur_id = $_SESSION['user_id'];

// Récupérer les livres favoris de l'utilisateur
$favoris = Favoris::getFavoris($utilisateur_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>

<header>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h1>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="logout.php">Se déconnecter</a>
</nav>

<h2>Mes livres favoris</h2>
<div class="favoris-list">
    <?php if (empty($favoris)): ?>
        <p>Aucun livre ajouté aux favoris.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($favoris as $livre): ?>
                <li>
                    <?php echo htmlspecialchars($livre['titre']) . " par " . htmlspecialchars($livre['auteur']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

</body>
</html>
