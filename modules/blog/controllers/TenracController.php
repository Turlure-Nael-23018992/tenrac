<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../views/tenrac.php';
require_once __DIR__ . '/../models/Tenrac/TenracDao.php';
require_once __DIR__ . '/../../../_assets/includes/database.php';

class TenracController {
    public function execute(): void {
        $this->tenracDao = new TenracDao(Database::getInstance());

        $tenracs = $this->tenracDao->getAllTenracs(); 
        (new TenracPage($tenracs))->show(); 
    }
}
?>
