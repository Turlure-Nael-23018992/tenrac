<?php
namespace blog\controllers\HomepageController;
use includes\database\databaseConnection, Blog\Models\HomePageRepository\HomePageRepository;

Class HomePageController {

    public function execute(): void
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    
    (new modules\blog\views\homepage())->show();
    }
    
}