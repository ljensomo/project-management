<?php

return [
    // Add some controller here..
    '/' => [
        'GET' => 'HomeController@index'
    ],
    '/login' => [
        'GET' => 'AuthController@index'
    ],
];