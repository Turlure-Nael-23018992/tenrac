<?php

function my_autoload(string $class): void {
    $class = str_replace('\\', '/', $class);
    include __DIR__ . '/' . $class . '.php';
}
spl_autoload_register('my_autoload');

