<?php

require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ .'../models/Tenrac/TenracDao.php';

class TenracController
{

    public function execute(): void
    {
        $TenracDao = new TenracDao(DatabaseConnection::getInstance());
        $Tenrac = $TenracDao->getTenracById(1);
    }

}

?>