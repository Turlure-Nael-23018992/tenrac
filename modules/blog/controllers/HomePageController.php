<?php

require_once __DIR__ . '/../models/Repas/RepasDao.php';

class HomePageController {
    private $userDAO;

    public function __construct($pdo) {
        $this->userDAO = new UserDao($pdo);
    }

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