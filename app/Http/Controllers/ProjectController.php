<?php

namespace App\Http\Controllers;

use App\Middleware\Session;

class ProjectController
{
    public function __construct()
    {
        Session::session();
    }

    public function index()
    {
        return view('projects/index.php');
    }
}