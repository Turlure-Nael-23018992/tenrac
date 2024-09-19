<?php
require_once __DIR__ . '/modules/blog/controllers/HomePageController.php';
require_once __DIR__ . '/_assets/includes/database.php';

function loadPage($page) {
    $controller = new HomePageController();

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

loadPage($page);

?>