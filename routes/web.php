<?php

use Core\Route;

Route::get('/', 'HomeController@index');
// Auth
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
// Project
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/all', 'ProjectController@all');
// User
Route::get('/users', 'UserController@index');
Route::get('/projects', 'ProjectController@index');
