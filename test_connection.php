<?php
require_once 'classes/db.php';

try {
    $conn = DB::getConnection();
    echo "Connexion réussie à la base de données !"; 
} catch (Exception $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
