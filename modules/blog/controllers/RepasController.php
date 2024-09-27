<?php
require_once 'modules/blog/views/repas.php';
require_once 'modules/blog/models/Repas/RepasDao.php';
require_once '_assets/includes/database.php';

class RepasController{

    public function execute(): void {
        
        $repasDao = new RepasDao(Database::getInstance());
        $repas = $repasDao->getLastsRepas(10);
        (new Repas($repas))->show(); 
    }
}
?>