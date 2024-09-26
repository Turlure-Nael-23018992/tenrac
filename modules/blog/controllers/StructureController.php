<?php

require_once __DIR__ . '/../views/homepage.php';
require_once __DIR__ . '/../models/Plat/PlatDao.php';
require_once __DIR__ . '/../../_assets/includes/database.php'; // Make sure this path is correct

class StructureController{

    public function execute(): void {
        echo "On est dans Structure";
        
        // Verify if the PDO connection works
        $pdo = Database::getInstance(); // No need for 'use' if Database is in the global namespace
        if ($pdo) {
            echo "PDO marche";
        } else {
            echo "PDO ne marche pas";
        }
        
        $clubDao = new Club($pdo);
        $plats = $platDao->getPlatById(1); // Fetch the plat by ID
        echo "salut c'est le controller";
        var_dump($plats);
        
        // Create an instance of Homepage and call show()
        (new Homepage($plats))->show();
    }
}