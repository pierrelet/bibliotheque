<?php
session_start();
require_once 'classes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livre_id = $_POST['livre_id'];
    $utilisateur_id = $_SESSION['user_id'];

    try {
        $conn = DB::getConnection();

        $query = "SELECT * FROM favoris WHERE utilisateur_id = ? AND livre_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$utilisateur_id, $livre_id]);
        $favorite = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$favorite) {
            $query = "INSERT INTO favoris (utilisateur_id, livre_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$utilisateur_id, $livre_id]);

            echo "Le livre a été ajouté à vos favoris !";
        } else {
            echo "Ce livre est déjà dans vos favoris.";
        }

    } catch (Exception $e) {
        echo "Erreur lors de l'ajout au favoris : " . $e->getMessage();
    }
}
?>
