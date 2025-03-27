<?php

namespace App\Http\Controllers;

use App\Models\Login;

class AuthController
{
    public function index()
    {
        return view('auth/login.html');
    }

    public function login()
    {
        session_start();

        if (isset($_POST)) {
            $login = new Login($_POST['username'], $_POST['password']);
        
            if(!$login->isValid()){
        
                exit(json_encode(['success' => false, 'message' => $login->getErrorMessage()]));
            }
        
            $_SESSION['user_id'] = $login->getUserid();
            $_SESSION['username'] = $login->getUsername();
            $_SESSION['name'] = $login->getFirstName().' '.$login->getLastName();
        
            exit(json_encode(['success' => true, 'message' => 'You have successfully logged in.']));
        
        }
        
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }

    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: /login");
    }
}