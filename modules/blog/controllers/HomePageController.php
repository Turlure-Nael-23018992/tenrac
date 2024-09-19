<?php
namespace blog\controllers\HomepageController;
use Includes\Database\DatabaseConnection, Blog\Models\Post\PostRepository;

Class HomePageController {
    /**
     * @return void
     */
    public function execute()
    {
        $repas = [
            [
                'nom' => 'Petit Déjeuner',
                'horaire' => '08:00 - 09:00',
                'lieu' => "Adresse 485115",
                "active" => true
            ],
            [
                'nom' => 'Déjeuner',
                'horaire' => '12:00 - 13:30',
                'lieu' => "10 Av. Paul Cézanne, 13090 Aix-en-Provence",
                "active" => true
            ],
            [
                'nom' => 'Dîner',
                'horaire' => '19:00 - 21:00',
                'lieu' => "Adresse 485115",
                "active" => false
            ]
        ];

        (new \blog\views\homepage\Homepage($repas))->show();
    }
    
}