<?php

// Affichage des erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../views/tenrac.php'; // Inclusion de la vue pour afficher les tenracs
require_once __DIR__ . '/../models/Tenrac/TenracDao.php'; // Inclusion du modèle TenracDao pour accéder aux données des tenracs
require_once __DIR__ . '/../../../_assets/includes/database.php'; // Inclusion de la classe pour la connexion à la base de données

class TenracController {
    private $tenracDao; // Propriété pour le modèle TenracDao

    public function execute(): void {
        // Création d'une instance de TenracDao pour accéder aux données des tenracs
        $this->tenracDao = new TenracDao(Database::getInstance());

        // Récupération de tous les tenracs
        $tenracs = $this->tenracDao->getAllTenracs(); 
        
        // Création d'une instance de TenracPage avec les données des tenracs et affichage
        (new TenracPage($tenracs))->show(); 
    }
}
?>
