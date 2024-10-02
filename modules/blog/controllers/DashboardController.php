<?php
require_once 'modules/blog/views/dashboard.php';
require_once 'modules/blog/models/Repas/RepasDao.php';
require_once 'modules/blog/models/Club/ClubDao.php';
require_once 'modules/blog/models/Tenrac/TenracDao.php';
require_once 'modules/blog/models/Plat/PlatDao.php';
require_once 'modules/blog/models/PlanningRepas/PlanningRepas.php';
require_once '_assets/includes/database.php';

class DashboardController {

    public function execute(): void {
        // Création d'une instance de RepasDao pour interagir avec la base de données des repas
        $repasDao = new RepasDao(Database::getInstance());
        $repas = $repasDao->getAllRepas(); // Récupération de tous les repas

        // Création d'une instance de ClubDao pour interagir avec la base de données des clubs
        $clubDao = new ClubDao(Database::getInstance());
        $club = $clubDao->getLastClubs(5); // Récupération des 5 derniers clubs

        // Création d'une instance de TenracDao pour interagir avec la base de données des tenracs
        $tenracDao = new TenracDao(Database::getInstance());
        $tenrac = $tenracDao->getLastTenracs(5); // Récupération des 5 derniers tenracs

        // Création d'une instance de PlatDao pour interagir avec la base de données des plats
        $platDao = new PlatDao(Database::getInstance());
        $plat = $platDao->getLastPlats(5); // Récupération des 5 derniers plats

        // Création d'une instance de PlanningRepasDao pour interagir avec la base de données de planification des repas
        $planningRepasDao = new PlanningRepasDao(Database::getInstance());
        $planning = $planningRepasDao->getAllPlanningRepas(); // Récupération de tous les plannings des repas

        // Affichage du tableau de bord avec toutes les données récupérées
        (new Dashboard($repas, $club, $tenrac, $plat, $planning))->show(); 
    }
}
?>
