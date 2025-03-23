<?php

namespace App\Controller;

use App\Core\View;

class HomeController {
    public function index() {
        $data = [
            'title' => 'Home Page'
        ];

        View::view('home', $data);
    }
}