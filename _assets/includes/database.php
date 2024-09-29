<?php
class Database {
    private static $instance = null;
    private $pdo;
    
    private $servername = "mysql-tenrac-projet.alwaysdata.net"; 
    private $username = "374958_leo"; 
    private $password = "tenracprojetmdp";
    private $dbname = "tenrac-projet_valentin";

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Échec de connexion à la base de données : " . $e->getMessage();
            exit;
        }
    }

    // Méthode pour récupérer l'instance unique
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
    // Empêcher le clonage de l'objet
    private function __clone() {}

    // Empêcher la désérialisation de l'objet
    public function __wakeup() {

    }
}

?>