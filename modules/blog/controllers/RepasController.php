<?php
require_once 'modules/blog/views/repas.php';
require_once 'modules/blog/models/Repas/RepasDao.php';
require_once '_assets/includes/database.php';

class RepasController{

    private $repasDao;

    public function __construct() {
        $this->repasDao = new RepasDao(Database::getInstance());
    }

    public function execute() {
        $repas = $this->repasDao->getLastRepas(5); 
        (new RepasPage($repas))->show(); 
    }
}
?>