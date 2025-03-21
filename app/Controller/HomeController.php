<?php

namespace App\Controller;

class HomeController {
    public function index() {
        include __DIR__ . '/../../resources/views/home.php';
    }
}