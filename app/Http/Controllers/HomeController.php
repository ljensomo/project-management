<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $data = [
            'title' => 'Project Management',
            'text' => 'Boost your productivity. Start using our app today.'
        ];

        return view('index.php', $data);
    }
}