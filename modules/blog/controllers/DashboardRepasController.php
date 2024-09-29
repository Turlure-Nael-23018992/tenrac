<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../views/dashboardRepas.php';
require_once __DIR__ . '/../models/PlanningRepas/PlanningRepasDao.php';
require_once __DIR__ . '/../../../_assets/includes/database.php';

class DashboardRepasController {

    public function execute(): void {
        $this->planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        $repas = $this->planningRepasDao->getAllPlanningRepas(); 
        (new DashboardRepas($repas))->show(); 
    }
}
?>
