<?php

use Core\View;

if (!function_exists('config')) {
    function config(string $file, string $key, $default = null)
    {
        $path = APP_ROOT . "config/{$file}.php";

        if (!file_exists($path)) {
            throw new \Exception("Configuration file '{$file}' not found.");
        }

        $data = require $path;

        $keys = explode('.', $key);
        foreach ($keys as $keyPart) {
            if (isset($data[$keyPart])) {
                $data = $data[$keyPart];
            } else {
                if ($default !== null) {
                    return $default;
                }
                throw new \Exception("Configuration key '{$key}' not found in '{$file}'");
            }
        }

        return $data;
    }
}

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