<?php

if (file_exists(__DIR__ . '/../views/homepage.php')) {
    require_once __DIR__ . '/../views/homepage.php';
} else {
    echo 'Fichier non trouvé';
}

require_once 'modules/blog/views/homepage.php';
require_once 'modules/blog/models/Plat/PlatDao.php';
require_once '_assets/includes/database.php';

class PlatController {
    private $platDao;
    public function execute(): void {
        $this->platDao = new PlatDao(Database::getInstance());

        $plats = $this->platDao->getAllPlats(); 
        (new PlatPage($plats, $this->platDao))->show(); 
    }
}
