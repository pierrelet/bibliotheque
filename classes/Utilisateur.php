<?php
class Utilisateur {
    private $id;
    private $nom;
    private $email;
    private $password;

    // Constructeur pour initialiser les attributs
    public function __construct($id, $nom, $email, $password) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
    }

    // Méthode pour inscrire un utilisateur
    public static function register($nom, $email, $password) {
        $db = DB::getConnection();
        $stmt = $db->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :password)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Hachage du mot de passe
        $stmt->execute();
    }

    // Méthode pour vérifier les informations de connexion
    public static function login($email, $password) {
        $db = DB::getConnection();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return new Utilisateur($user['id'], $user['nom'], $user['email'], $user['password']);
        }
        return null;
    }

    // Accesseurs pour récupérer les attributs
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }
}
?>
