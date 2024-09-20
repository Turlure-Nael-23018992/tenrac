
<?php

require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ .'../models/Repas/RepasDAO.php';

class RepasController
{

    public function execute(): void
    {
        $RepasDAO = new RepasDAO(DatabaseConnection::getInstance());
        $Repas = $RepasDAO->getRepasById(1);
        
    }

}

?><?php

require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ .'../models/Tenrac/TenracDao.php';

class HomePageController1
{

    public function execute(): void
    {
        $TenracDao = new TenracDao(DatabaseConnection::getInstance());
        $Tenrac = $TenracDao->getTenracById();
    }

}

?>