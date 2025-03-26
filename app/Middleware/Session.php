<?php

namespace App\Middleware;

class Session
{
    public static function session()
    {
        session_start();

        if (!isset($_SESSION['username'])) {
            header("Location: /login");
            exit();
        }
    }
}