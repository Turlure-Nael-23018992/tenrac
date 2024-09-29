<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../views/dashboardClub.php';
require_once __DIR__ . '/../models/Club/ClubDao.php';
require_once __DIR__ . '/../../../_assets/includes/database.php';

class DashboardClubController {

    public function execute(): void {
        $this->clubDao = new ClubDao(Database::getInstance());

        $clubs = $this->clubDao->getAllClubs(); 
        (new DashboardClub($clubs))->show(); 
    }

}
?>
