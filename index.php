<?php
require '_assets/includes/autoloader.php';
try {
    if (filter_input(INPUT_GET, 'action')) {
        switch($_GET['action']) {
            case 'homepage':
                (new \Blog\Controllers\HomePageController\HomePageController())->execute();
                break;
            case 'struture':
                (new \Blog\Controllers\StructureController\StructureController())->execute();
                break;
            default:
                throw new ControllerException('La page que vous recherchez n\'existe pas');
        }
        
    }
    (new \Blog\Controllers\HomePageController\Homepage())->execute();
} catch (ControllerException $e) {
    (new \Blog\Views\Error($e->getMessage()))->show();
}