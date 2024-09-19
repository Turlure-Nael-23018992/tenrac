<?php
namespace Blog\Controllers\Homepage;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class HomePageController {

    public function execute(): void
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    
    (new \Blog\Views\homepage($posts))->show();
    }
    
}