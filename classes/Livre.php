<?php
class Livre {
    private $id;
    private $titre;
    private $auteur;

  
    public function __construct($id, $titre, $auteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
    }

    public static function getAllBooks() {
        $db = DB::getConnection();
        $query = $db->query("SELECT * FROM livres");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function addBook($titre, $auteur, $utilisateur_id) {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO livres (titre, auteur, utilisateur_id) VALUES (:titre, :auteur, :utilisateur_id)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
    }

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
