<?php

// Inclusion des fichiers nécessaires
require_once 'modules/blog/views/structure.php'; // Inclusion de la vue pour afficher la structure des clubs
require_once 'modules/blog/models/Club/ClubDao.php'; // Inclusion du modèle ClubDao pour accéder aux données des clubs
require_once '_assets/includes/database.php'; // Inclusion de la classe pour la connexion à la base de données

class StructureController {

    private $clubDao; // Propriété pour le modèle ClubDao

    public function execute(): void {
        // Création d'une instance de ClubDao pour accéder aux données des clubs
        $this->clubDao = new ClubDao(Database::getInstance());

        // Récupération de tous les clubs
        $clubs = $this->clubDao->getAllClubs(); 
        
        // Création d'une instance de Structure avec les données des clubs et affichage
        (new Structure($clubs))->show(); 
    }
}
?>
