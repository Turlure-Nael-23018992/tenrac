<?php
require_once 'modules/blog/views/homepage.php'; // Inclusion de la vue de la page d'accueil
require_once 'modules/blog/models/Plat/PlatDao.php'; // Inclusion du modèle pour gérer les plats
require_once '_assets/includes/database.php'; // Inclusion de la classe pour la connexion à la base de données

class HomePageController {

    public function execute(): void {
        // Création d'une instance de PlatDao pour accéder aux données des plats
        $platDao = new PlatDao(Database::getInstance());
        
        // Récupération des informations sur le plat avec ID 1
        $plats = $platDao->getPlatById(1); 
        
        // Création d'une instance de Homepage avec les données du plat et affichage
        (new Homepage($plats))->show(); 
    }
}
?>
