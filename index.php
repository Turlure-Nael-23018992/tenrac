<?php

require_once __DIR__ . '/_assets/includes/database.php';
require_once __DIR__ . '/modules/blog/controllers/HomePageController.php'; 

function loadPage($page, PDO $pdo) {
    $controller = new HomePageController($pdo);

    switch ($page) {
        case 'homepage':
            $controller->showHomePage();
            break;
        case 'login':
            $controller->showLoginPage();
            break;
        default:
            $controller->show404();
            break;
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
loadPage($page, $pdo);

?>