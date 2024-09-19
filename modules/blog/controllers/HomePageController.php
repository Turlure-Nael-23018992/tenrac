<?php
namespace modules\blog\controllers\HomePageController;

use Blog\Models\HomePageRepository\HomePageRepository;
use Includes\Database\DatabaseConnection;

class HomePageController {
    public function execute(): void {
        $homepageRepository = new HomePageRepository(DatabaseConnection::getInstance());
        (new \modules\blog\views\homepage())->show();
    }
}
