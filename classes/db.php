<?php
class DB {
    private static $host = 'localhost';        // Nom de l'hôte
    private static $dbname = 'bibliotheque';   // Nom de la base de données
    private static $username = 'postgres';     // Nom d'utilisateur
    private static $password = '2005';         // Mot de passe de l'utilisateur
    private static $db;

    public static function getConnection() {
        if (!self::$db) {
            try {
                self::$db = new PDO(
                    "pgsql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$db;
    }
}
