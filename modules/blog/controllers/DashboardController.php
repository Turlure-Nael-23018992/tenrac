<?php
require_once 'modules/blog/views/dashboard.php';
require_once 'modules/blog/models/Repas/RepasDao.php';
require_once '_assets/includes/database.php';

class DashboardController {

    public function execute(): void {
        $repasDao = new RepasDao(Database::getInstance());
        $repas = $repasDao->getNextRepas(5); 
        (new Dashboard($repas))->show(); 
    }

    
}