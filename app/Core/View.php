<?php

namespace App\Core;

use Exception;

class View {
    protected static $viewPath = __DIR__ . '/../../resources/views/';

    public static function view($viewName, $data = null) {
        $viewFile = self::$viewPath . $viewName;

        if (!pathinfo($viewFile, PATHINFO_EXTENSION)) {
            $viewFile .= '.php';
        }

        if (pathinfo($viewFile, PATHINFO_EXTENSION) === 'php' && $data) {
            extract($data);
        }

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: {$viewFile}");
        }

        include $viewFile;
    }
}