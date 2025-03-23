<?php

namespace App\Controller;

use App\Core\View;

class AuthController {
    public function index() {
        View::view('auth/login.html');
    }
}