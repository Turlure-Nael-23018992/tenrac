<?php
class Database {
    private static $instance = null; // Instance unique de la classe
    private $pdo; // Instance de PDO pour la connexion à la base de données
    
    // Informations de connexion à la base de données
    private $servername = "mysql-tenrac-projet.alwaysdata.net"; 
    private $username = "374958_admin2"; 
    private $password = "tenracprojetmdp";
    private $dbname = "tenrac-projet_valentin";

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {
        try {
            // Tentative de connexion à la base de données
            $this->pdo = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Affichage des erreurs
        } catch (PDOException $e) {
            echo "Échec de connexion à la base de données : " . $e->getMessage();
            exit; // Arrêt du script en cas d'erreur
        }
    }

    // Méthode pour récupérer l'instance unique
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database(); // Création d'une nouvelle instance si aucune n'existe
        }
        return self::$instance->pdo; // Retourne l'instance de PDO
    }

    // Empêcher le clonage de l'objet
    private function __clone() {}

    // Empêcher la désérialisation de l'objet
    public function __wakeup() {}
}
?>
