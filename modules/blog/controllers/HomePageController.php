<?php

require_once __DIR__ . '/PlatController.php';

class HomePageController {


    public function showHomePage() {
        require_once __DIR__ . '/../views/homepage.php';
        (new PlatController())->execute();
    }

    public function showLoginPage() {
        require_once __DIR__ . '/../views/login.php';
    }

    public function show404() {
        require_once __DIR__ . '/../views/404.php';
    }

    //public function showStructure() {
     //   require_once __DIR__ . '/../views/structure.php';
     //   (new StructureController())->execute();
    //}
}



?>