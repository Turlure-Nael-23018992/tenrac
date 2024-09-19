<?php

namespace App\Controllers;

use Includes\Database\DatabaseConnection;
use Models\Plat\PlatDao;
use Modules\Blog\Views\Homepage;

class PlatController {

    public function execute(): void {
        $platDao = new PlatDao(DatabaseConnection::getInstance());
        $plats = $platDao->getPlatById(1); // On récupère le plat

        // Créer une instance de Homepage et appeler show()
        (new Homepage($plats))->show();
    }
}
