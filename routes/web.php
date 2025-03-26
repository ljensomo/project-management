<?php

use Core\Route;

Route::get('/', 'HomeController@index');
// Auth
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
// Project
Route::get('/projects', 'ProjectController@index');