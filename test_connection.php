<?php
// Inclure le fichier db.php pour utiliser la connexions
require_once 'classes/db.php';

// Tester la connexion
try {
    $conn = DB::getConnection();
    echo "Connexion réussie à la base de données !";  // Si la connexion fonctionne
} catch (Exception $e) {
    // Afficher un message d'erreur si la connexion échoue
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
