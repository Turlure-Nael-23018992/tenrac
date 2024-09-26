<?php
require_once 'modules/blog/views/homepage.php';
require_once 'modules/blog/models/Plat/PlatDao.php';
require_once '_assets/includes/database.php';

class PlatController {

    public function execute(): void {
        
        $platDao = new PlatDao(Database::getInstance());
        $plats = $platDao->getPlatById(1); 
               
        (new PlatPage($plats))->show(); 
    }
}
