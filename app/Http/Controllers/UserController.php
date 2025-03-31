<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Middleware\Session;

class UserController{
    public function __construct()
    {
        Session::session();
    }

    public function index()
    {
        return view('users/index.php');
    }

    public function all()
    {
        // $user = new User();
        // $data = $user->getAllUsers();

        // echo json_encode(['data' => $data]);
    }
}