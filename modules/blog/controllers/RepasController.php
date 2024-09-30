<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../views/repas.php';
require_once __DIR__ . '/../models/PlanningRepas/PlanningRepasDao.php';
require_once __DIR__ . '/../../../_assets/includes/database.php';

class RepasController {

    public function execute(): void {
        $this->planningRepasDao = new PlanningRepasDAO(Database::getInstance());

        $repas = $this->planningRepasDao->getAllPlanningRepas(); 
        (new RepasPage($repas))->show(); 
    }
}
?>
