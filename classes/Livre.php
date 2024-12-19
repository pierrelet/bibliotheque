<?php
class Livre {
    private $id;
    private $titre;
    private $auteur;

    // Constructeur pour initialiser les attributs
    public function __construct($id, $titre, $auteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
    }

    // Méthode pour obtenir la liste des livres
    public static function getAllBooks() {
        $db = DB::getConnection();
        $query = $db->query("SELECT * FROM livres");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour ajouter un livre dans la base de données
    public static function addBook($titre, $auteur, $utilisateur_id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO livres (titre, auteur, utilisateur_id) VALUES (:titre, :auteur, :utilisateur_id)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

    // Accesseurs pour récupérer les attributs
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getAuteur() {
        return $this->auteur;
    }
}
?>
