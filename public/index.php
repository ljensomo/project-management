<?php

use App\Router\Router;

// Autoload Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->loadRoutes(__DIR__ . '/../routes/routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);