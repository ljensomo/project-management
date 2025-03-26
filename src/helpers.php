<?php

use Core\View;

if (!function_exists('view')) {
    function view($name, $data = null)
    {
        View::view($name, $data);
    }
}