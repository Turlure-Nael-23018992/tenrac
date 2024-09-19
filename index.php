<?php
require '_assets/includes/autoloader.php';

try {
    // Check if an 'action' parameter exists in the URL
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

    if ($action) {
        switch ($action) {
            case 'homepage':
                (new \modules\blog\controllers\HomePageController\HomePageController())->execute();
                break;

            case 'structure':
                (new \modules\blog\controllers\StructureController\StructureController())->execute();
                break;

            default:
                throw new ControllerException('La page que vous recherchez n\'existe pas.');
        }
    } else {
        (new \modules\blog\controllers\HomePageController\HomePageController())->execute();
    }

} catch (ControllerException $e) {
    (new \Blog\Views\Error($e->getMessage()))->show();
}