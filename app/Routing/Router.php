<?php

namespace ContactsApp\Routing;

use Closure;

use ContactsApp\Exceptions\HttpNotFoundException;

class Router {
    /**
     * Registered routes.
     * 
     * @var array<string, array<string, Closure|array>>
     */
    public static array $routes = [
        HttpMethod::GET->value => [],
        HttpMethod::POST->value => [],
    ];

    /**
     * Executes the action associate with the current request route.
     * 
     * @throws HttpNotFoundException If the current request route is not registered in routes property.
     */
    public static function resolve(): void
    {
        // $route = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
        $route = $_SERVER["PATH_INFO"] ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];
        
        $route = $route != "/" && str_ends_with($route, "/") ? substr($route, 0, strlen($route) - 1) : $route;
        $action = self::$routes[$method][$route] ?? null;

        if (is_null($action)) {
            throw new HttpNotFoundException("Error 404: Resource $route not found.");
        }

        call_user_func($action);
    }

    /**
     * Register a new route with its corresponding action for HTTP GET method.
     * 
     * @param string $route
     * @param Closure|array $action
     */
    public static function get(string $route, Closure|array $action): void
    {
        self::$routes[HttpMethod::GET->value][$route] = $action;     
    }

    /**
     * Register a new route with its corresponding action for HTTP POST method.
     * 
     * @param string $route
     * @param Closure|array $action
     */
    public static function post(string $route, Closure|array $action): void
    {
        self::$routes[HttpMethod::POST->value][$route] = $action;     
    }
}
