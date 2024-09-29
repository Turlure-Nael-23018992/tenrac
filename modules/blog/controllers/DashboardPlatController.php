<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../views/dashboardPlat.php';
require_once __DIR__ . '/../models/Plat/PlatDao.php';
require_once __DIR__ . '/../../../_assets/includes/database.php';

class dashboardPlatController {

    public function execute(): void {
        $this->platDao = new PlatDao(Database::getInstance());

        $plats = $this->platDao->getAllPlats(); 
        (new dashboardPlat($plats, $this->platDao))->show(); 
    }

}
?>
