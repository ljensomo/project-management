<?php

namespace Core;

class Route
{
    private static $routes = [];

    public static function load($file)
    {
        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new \Exception("Route file not found.");
        }
    }

    public static function add($method, $uri, $action)
    {
        self::$routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public static function get($uri, $action)
    {
        self::add('GET', $uri, $action);
    }

    public static function post($uri, $action)
    {
        self::add('POST', $uri, $action);
    }

    public static function patch($uri, $action)
    {
        self::add('PATCH', $uri, $action);
    }

    public static function delete($uri, $action)
    {
        self::add('DELETE', $uri, $action);
    }

    public static function resolve($requestUri, $requestMethod)
    {
        foreach (self::$routes as $route) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $route['uri']);
            $pattern = "@^" . $pattern . "$@";

            if ($route['method'] === strtoupper($requestMethod) && preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);

                if (is_string($route['action']) && strpos($route['action'], '@') !== false) {
                    list($controller, $method) = explode('@', $route['action']);

                    $controller = 'App\\Http\\Controllers\\' . $controller;

                    if (class_exists($controller) && method_exists($controller, $method)) {
                        $instance = new $controller();
                        return call_user_func_array([$instance, $method], $matches);
                    } else {
                        throw new \Exception("Controller or Method Not Found: {$controller}@{$method}");
                    }
                }

                if (is_callable($route['action'])) {
                    return call_user_func_array($route['action'], $matches);
                }
            }
        }

        throw new \Exception("No matching route found for URI: {$requestUri} and Method: {$requestMethod}");
    }
}