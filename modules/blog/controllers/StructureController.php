<?php
namespace \modules\blog\controllers\StructureController;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class StructureController {

    /**
     * @return void
     */
    public function execute(): void
    {
    $homepageRepository = new PostRepository(DatabaseConnection::getInstance());
    
    (new \Blog\Views\homepage($posts))->show();
    }
    
}