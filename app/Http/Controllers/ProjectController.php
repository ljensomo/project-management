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
        $project = new Project();
        $data = $project->getAllProjects();
        
        $header = $_SERVER['HTTP_ACCEPT'] ?? '';
        if (strpos($header, 'application/json') !== false) {
            echo json_encode(['data' => $data]);
            exit;
        }
        
        return view('projects/index.php', ['projects' => $data]);
    }
}