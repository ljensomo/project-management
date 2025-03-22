<?php

namespace App\Controller;

class AuthController {
    public function index() {
        include __DIR__ . '/../../resources/views/auth/login.html';
    }
}