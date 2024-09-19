<?php

require_once __DIR__ . '/../_assets/includes/database.php';
require_once __DIR__ . '/../models/Sauce/SauceDao.php';

class SauceController {

    public function execute(): void {
        $sauceDao = new SauceDao(DatabaseConnection::getInstance());
        $sauces = $sauceDao->getSauceById(1);

        require_once __DIR__ . '/../views/homepage.php';
        $homepage = new Homepage($sauces);
        $homepage->show();
    }
}