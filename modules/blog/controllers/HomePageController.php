<?php
namespace blog\controllers\HomepageController;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class HomePageController {
    public function execute(): void
    {

        (new \blog\views\homepage\Homepage())->show();
    }
    
}