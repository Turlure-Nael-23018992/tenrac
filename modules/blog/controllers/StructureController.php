<?php
namespace Blog\Controllers\StructureController;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class HomePageController {

    public function execute(): void
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    
    (new \Blog\Views\homepage($posts))->show();
    }
    
}