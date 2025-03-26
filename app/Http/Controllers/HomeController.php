<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $data = [
            'title' => 'Project Management',
            'head' => 'Project Management Tool',
            'description' => 'This is created with PHP, HTML5, Tailwind CSS, JAVASCRIPT and MySQL. Build started on July 16, 2023'
        ];

        return view('index.php', $data);
    }
}