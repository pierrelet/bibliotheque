<?php
require 'classes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = DB::getConnection();
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Bibliothèque en ligne</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

<header>
    <h1>Connexion à la Bibliothèque en ligne</h1>
</header>

<nav>
    <a href="index.php">Accueil</a>
    <a href="register.php">S'inscrire</a>
    <a href="login.php">Se connecter</a>
    <a href="dashboard.php">Mon tableau de bord</a>
</nav>

<div class="main-content">
    <form action="login.php" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>

        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </form>
</div>

<footer>
    <p>&copy; 2024 Bibliothèque en ligne</p>
</footer>

</body>
</html>