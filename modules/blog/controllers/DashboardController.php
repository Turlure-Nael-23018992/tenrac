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

        $repasDao = new RepasDao(Database::getInstance());
        $repas = $repasDao->getAllRepas(); 

        $clubDao = new ClubDao(Database::getInstance());
        $club = $clubDao->getLastClubs(5);

        $tenracDao = new TenracDao(Database::getInstance());
        $tenrac = $tenracDao->getLastTenracs(5);

        $platDao = new PlatDao(Database::getInstance());
        $plat = $platDao->getLastPlats(5);

        $planningRepasDao = new PlanningRepasDao(Database::getInstance());
        $planning = $planningRepasDao->getAllPlanningRepas();

        (new Dashboard($repas,$club, $tenrac, $plat, $planning))->show(); 
    }

}