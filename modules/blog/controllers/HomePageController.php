<?php
namespace blog\controllers\HomepageController;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class HomePageController {
    /**
     * @return void
     */
    public function execute()
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    (new modules\blog\views\homepage\Homepage())->show($homepageRepository);
    }
    
}