<?php
// Connexion à la base de données
require 'classes/db.php';
require 'classes/Livre.php';
require 'classes/Favoris.php';

session_start();

// Récupérer les livres disponibles
$livres = Livre::getAllBooks();

// Ajouter un livre aux favoris si l'utilisateur est connecté
if (isset($_POST['add_favori']) && isset($_SESSION['user_id'])) {
    $utilisateur_id = $_SESSION['user_id'];
    $livre_id = $_POST['livre_id'];
    Favoris::addFavori($utilisateur_id, $livre_id);
    header("Location: index.php"); // Recharger la page pour voir le changement
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en ligne</title>
</head>
<body>

<header>
    <h1>Bienvenue dans notre Bibliothèque en ligne</h1>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="register.php">S'inscrire</a>
    <a href="login.php">Se connecter</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php">Mon tableau de bord</a>
    <?php endif; ?>
</nav>

<div class="main-content">
    <div class="book-list">
        <?php foreach ($livres as $livre): ?>
            <div class="book-item">
                <h3><?php echo htmlspecialchars($livre['titre']); ?></h3>
                <p>Par <?php echo htmlspecialchars($livre['auteur']); ?></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Formulaire pour ajouter aux favoris -->
                    <form action="index.php" method="POST">
                        <input type="hidden" name="livre_id" value="<?php echo $livre['id']; ?>">
                        <button type="submit" name="add_favori">Ajouter aux favoris</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Bibliothèque en ligne</p>
</footer>

</body>
</html>
