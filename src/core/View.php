<?php

namespace Core;

class View
{
    protected static $path = APP_ROOT . '/resources/views/';

    public static function view($name, $data = null)
    {
        $file = self::$path . $name;

        if (!pathinfo($file, PATHINFO_EXTENSION)) {
            $file .= '.php';
        }

        if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && $data) {
            extract($data);
        }

        if (!file_exists($file)) {
            throw new \Exception("View file not found: {$file}");
        }

        include $file;
    }
}