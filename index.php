<?php

require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ . '/modules/blog/controllers/HomePageController.php'; 


function loadPage($page, PDO $pdo) {
    

    switch ($page) {
        case 'homepage':
            require_once __DIR__ . '/modules/blog/views/homepage.php';
            (new HomePageController())->execute();
            break;
        default:
            echo '404';
            break;
    }
}
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
loadPage($page, Database::getInstance());

?>