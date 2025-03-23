<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function loadRoutes($file) {
        $this->routes = require $file;
    }

    public function dispatch($uri, $method) {
        foreach ($this->routes as $route => $methods) {
            if (isset($methods[$method])) {
                $routePattern = preg_replace('/\{(\w+)\}/', '(\w+)', $route);
                $routePattern = '#^' . $routePattern . '$#';

                if (preg_match($routePattern, $uri, $matches)) {
                    array_shift($matches);

                    list($controllerClass, $methodName) = $methods[$method];

                    if (!class_exists($controllerClass)) {
                        include_once "../Controller/{$controllerClass}.php";
                    }

                    $controller = new $controllerClass();

                    call_user_func_array([$controller, $methodName], $matches);
                    return;
                }
            }
        }

        echo "404 Not Found - The route does not exist.";
    }
}