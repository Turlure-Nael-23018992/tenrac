<?php

// Activation de l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../views/repas.php'; // Inclusion de la vue des repas
require_once __DIR__ . '/../models/PlanningRepas/PlanningRepasDao.php'; // Inclusion du modèle PlanningRepasDAO
require_once __DIR__ . '/../../../_assets/includes/database.php'; // Inclusion de la classe pour la connexion à la base de données

class RepasController {

    private $planningRepasDao; // Propriété pour le modèle PlanningRepasDAO

    public function execute(): void {
        // Création d'une instance de PlanningRepasDAO pour accéder aux données des repas
        $this->planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        // Récupération de tous les repas
        $repas = $this->planningRepasDao->getAllPlanningRepas(); 
        
        // Création d'une instance de RepasPage avec les données des repas et affichage
        (new RepasPage($repas))->show(); 
    }
}
?>
