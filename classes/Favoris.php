<?php
class Favoris {
    private $utilisateur_id;
    private $livre_id;

    // Constructeur pour initialiser les attributs
    public function __construct($utilisateur_id, $livre_id) {
        $this->utilisateur_id = $utilisateur_id;
        $this->livre_id = $livre_id;
    }

    // Méthode pour ajouter un livre aux favoris
    public static function addFavori($utilisateur_id, $livre_id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO favoris (utilisateur_id, livre_id) VALUES (:utilisateur_id, :livre_id)");
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':livre_id', $livre_id);
        $stmt->execute();
    }

    // Méthode pour récupérer les favoris d'un utilisateur
    public static function getFavoris($utilisateur_id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT livres.id, livres.titre, livres.auteur FROM favoris
                              INNER JOIN livres ON favoris.livre_id = livres.id
                              WHERE favoris.utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
