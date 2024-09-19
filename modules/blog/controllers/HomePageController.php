<?php

class HomePageController {
    public function showHomePage() {
        require __DIR__ . '/../views/homepage.php';
    }

    public function showLoginPage() {
        require __DIR__ . '/../views/login.php';
    }

    public function show404() {
        require __DIR__ . '/../views/404.php';
    }
}



?>