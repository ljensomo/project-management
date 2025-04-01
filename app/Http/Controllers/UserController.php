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
        $user = new User();
        $data = $user->getAllUsers();
        
        $header = $_SERVER['HTTP_ACCEPT'] ?? '';
        if (strpos($header, 'application/json') !== false) {
            echo json_encode(['data' => $data]);
            exit;
        }

        return view('users/index.php', ['users' => $data]);
    }

    public function add(){
        $user = new User();
        $user->setFirstName($_POST['first_name']);
        $user->setLastName($_POST['last_name']);
        $user->setEmail($_POST['email']);
        $user->setRole($_POST['role']);
        $user->setUsername();
        
        if($user->add()){
            echo json_encode(['success' => true, 'message' => 'User added successfully.']);
        }else{
            echo json_encode(['success' => false, 'message' => $user->getErrorMessage()]);
        }

        return;
    }
}