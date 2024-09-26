<?php
require_once 'modules/blog/views/structure.php';
require_once 'modules/blog/models/Club/ClubDao.php';
require_once '_assets/includes/database.php';

class StructureController {

    public function execute(): void {
        
        $clubDao = new ClubDao(Database::getInstance());
        $club = $clubDao->getLastClubs(10);
        (new Structure($club))->show(); 
    }
}