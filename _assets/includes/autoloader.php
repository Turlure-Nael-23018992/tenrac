<?php

spl_autoload_register(function ($class) {
    // Base directory for the namespace prefix (adjust if needed)
    $baseDir = __DIR__ . '/../../';  

    // Replace namespace separators with directory separators (backslashes to slashes)
    $classPath = str_replace('\\', '/', $class) . '.php';

    // Full path to the class file
    $file = $baseDir . $classPath;

    // Log the class being loaded and the corresponding file path
    error_log("Attempting to autoload class: {$class}");
    error_log("File path: {$file}");

    // Check if the file exists and require it if it does
    if (file_exists($file)) {
        require $file;
    } else {
        throw new Exception("Class file for {$class} not found at path {$file}");
    }
});
