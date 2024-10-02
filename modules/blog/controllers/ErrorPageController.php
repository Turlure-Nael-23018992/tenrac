<?php
require_once 'modules/blog/views/404.php'; // Inclusion de la vue d'erreur 404

class ErrorPageController {

    public function execute(): void {
        // Création d'une instance de la page d'erreur
        (new ErrorPage())->show(); // Appel de la méthode show pour afficher la page d'erreur
    }
}
?>
