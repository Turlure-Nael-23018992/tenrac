<?php
namespace Blog\Controllers\HomepageController;
use Includes\Database\DatabaseConnection, Blog\Models\HomePageRepository\HomePageRepository;

Class HomePageController {

    public function execute(): void
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    
    (new \Blog\Views\homepage($posts))->show();
    }
    
}