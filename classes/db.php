<?php
class DB {
    private static $host = 'localhost';        
    private static $dbname = 'bibliotheque';   
    private static $username = 'postgres';     
    private static $password = '2005';         
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
