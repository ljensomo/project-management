<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

    public function all()
    {
        $project = new Project();
        $data = $project->getAllProjects();

        echo json_encode(['data' => $data]);
    }
}