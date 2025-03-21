<?php

namespace App\Router;

class Router {
    protected $routes = [];

    public function loadRoutes($file) {
        $this->routes = require $file;
    }

    public function dispatch($uri, $method) {
        if (isset($this->routes[$uri][$method])) {
            list($controllerName, $methodName) = explode('@', $this->routes[$uri][$method]);

            $controllerClass = 'App\\Controller\\' . $controllerName;

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    echo "Method '$methodName' not found in '$controllerClass'.";
                }
            } else {
                echo "Controller '$controllerClass' not found.";
            }
        } else {
            echo "404 Not Found - The route does not exist.";
        }
    }
}