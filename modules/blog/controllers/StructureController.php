<?php
require_once 'modules/blog/views/structure.php';
require_once 'modules/blog/models/Club/ClubDao.php';
require_once '_assets/includes/database.php';

class StructureController {

    public function execute(): void {
        $this->clubDao = new ClubDao(Database::getInstance());

        $clubs = $this->clubDao->getAllClubs(); 
        (new Structure($clubs))->show(); 
    }
}