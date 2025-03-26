<?php

use Core\Route;

require_once APP_ROOT . 'vendor/autoload.php';

Route::load(APP_ROOT . 'routes/web.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

Route::resolve($uri, $method);