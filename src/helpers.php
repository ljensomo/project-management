<?php

use Core\View;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('view')) {
    function view($name, $data = null)
    {
        View::view($name, $data);
    }
}