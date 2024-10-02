<?php
include_once '_assets/includes/autoloader.php';
require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ . '/modules/blog/controllers/HomePageController.php'; 
require_once __DIR__ . '/modules/blog/controllers/StructureController.php'; 
require_once __DIR__ . '/modules/blog/controllers/PlatController.php'; 
require_once __DIR__ . '/modules/blog/controllers/RepasController.php';
require_once __DIR__ . '/modules/blog/controllers/DashboardController.php';
require_once __DIR__ . '/modules/blog/controllers/TenracController.php';
require_once __DIR__ . '/modules/blog/controllers/ErrorPageController.php';
function loadPage($page, PDO $pdo) {
    switch ($page) {
        case 'homepage':
            require_once __DIR__ . '/modules/blog/views/homepage.php';
            $title = 'Accueil';
            (new HomePageController())->execute();
            break;
        case 'structure':
            require_once __DIR__ . '/modules/blog/views/structure.php';
            (new StructureController())->execute();
            break;
        case 'plats':
            require_once __DIR__ . '/modules/blog/views/plat.php';
            (new PlatController())->execute();
            break;
        case 'repas':
            require_once __DIR__ . '/modules/blog/views/repas.php';
            (new RepasController())->execute();
            break;
        
        case 'dashboard':
            require_once __DIR__ . '/modules/blog/views/dashboard.php';
            (new DashboardController())->execute();
            break;
        case 'tenrac':
            require_once __DIR__ . '/modules/blog/views/tenrac.php';
            (new TenracController())->execute();
            break;
        default:
            require_once __DIR__ . '/modules/blog/views/404.php';
            (new ErrorPageController())->execute();
            break;
    }
}
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
loadPage($page, Database::getInstance());

?>