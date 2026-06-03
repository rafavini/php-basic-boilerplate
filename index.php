<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require $file;
});

$config = require __DIR__ . '/config/app.php';
define('BASE_URL', $config['base_folder']);

$router = new Core\Router();
require_once __DIR__ . '/app/Routes/routes.php';
$router->dispatch();
