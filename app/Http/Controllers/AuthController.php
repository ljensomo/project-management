<?php

namespace App\Http\Controllers;

class AuthController
{
    public function index()
    {
        return view('auth/login.html');
    }
}