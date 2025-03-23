<?php

use App\Controller\AuthController;
use App\Controller\HomeController;

return [
    // Add some controller here..
    '/' => [
        'GET' => [HomeController::class, 'index']
    ],
    '/login' => [
        'GET' => [AuthController::class, 'index']
    ],
];