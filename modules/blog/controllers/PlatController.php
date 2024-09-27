<?php

if (file_exists(__DIR__ . '/../views/homepage.php')) {
    require_once __DIR__ . '/../views/homepage.php';
} else {
    echo 'Fichier non trouvé';
}

require_once 'modules/blog/views/homepage.php';
require_once 'modules/blog/models/Plat/PlatDao.php';
require_once '_assets/includes/database.php';

class PlatController {
    private $platDao;

    public function __construct() {
        $this->platDao = new PlatDao(Database::getInstance());
    }

    public function execute(): void {
        $plats = $this->platDao->getPlatById(1); 
        (new PlatPage($plats))->show(); 
    }


     // Ajouter un plat
     public function addPlat(): void {
        if (isset($_POST['nom_plat'])) {
            $nom = $_POST['nom_plat'];
            if ($this->platDao->addPlat($nom)) {
                // Redirection vers la page de liste des plats après ajout
                header('Location: /plat');
                exit();
            } else {
                echo 'Erreur lors de l\'ajout du plat.';
            }
        }
    }
}
