<?php

session_start();

// Simple Autoloader
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../app/';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Load Routes
$router = new Core\Router();
require_once __DIR__ . '/../app/Routes/web.php';

// Dispatch
$router->dispatch();
