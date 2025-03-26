<?php

use Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/login', 'AuthController@index');