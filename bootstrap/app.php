<?php

use Core\Route;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once APP_ROOT . 'vendor/autoload.php';

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->safeLoad();

Route::load(APP_ROOT . 'routes/web.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

Route::resolve($uri, $method);