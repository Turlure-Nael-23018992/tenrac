<?php
require_once 'modules/blog/views/404.php';

class ErrorPageController {

    public function execute(): void {
         
        (new ErrorPage())->show(); 
    }
}