<?php
session_start();
require_once 'classes/db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    $conn = DB::getConnection();

    // Récupérer les livres favoris de l'utilisateur
    $utilisateur_id = $_SESSION['user_id'];
    $query = "SELECT livres.titre, livres.auteur
              FROM livres
              JOIN favoris ON livres.id = favoris.livre_id
              WHERE favoris.utilisateur_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$utilisateur_id]);
    $favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erreur de connexion ou d'exécution de la requête : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Tableau de bord</h1>

    <h2>Vos livres favoris :</h2>
    <ul>
        <?php if (empty($favoris)): ?>
            <li>Aucun livre favori pour le moment.</li>
        <?php else: ?>
            <?php foreach ($favoris as $livre): ?>
                <li><?php echo htmlspecialchars($livre['titre']); ?> par <?php echo htmlspecialchars($livre['auteur']); ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <p><a href="logout.php">Se déconnecter</a></p>
</body>
</html>
