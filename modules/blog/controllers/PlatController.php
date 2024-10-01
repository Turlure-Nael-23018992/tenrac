<?php

// Vérification de l'existence de la vue homepage.php
if (file_exists(__DIR__ . '/../views/homepage.php')) {
    require_once __DIR__ . '/../views/homepage.php';
} else {
    echo 'Fichier non trouvé'; // Message d'erreur si le fichier n'est pas trouvé
}

// Inclusion des autres fichiers nécessaires
require_once 'modules/blog/views/homepage.php'; // Inclusion de la vue des plats
require_once 'modules/blog/models/Plat/PlatDao.php'; // Inclusion du modèle pour les plats
require_once '_assets/includes/database.php'; // Inclusion de la classe pour la connexion à la base de données

class PlatController {
    private $platDao; // Propriété pour le modèle PlatDao

    public function execute(): void {
        // Création d'une instance de PlatDao pour accéder aux données des plats
        $this->platDao = new PlatDao(Database::getInstance());

        // Récupération de tous les plats
        $plats = $this->platDao->getAllPlats(); 
        
        // Création d'une instance de PlatPage avec les données des plats et affichage
        (new PlatPage($plats, $this->platDao))->show(); 
    }
}
?>
