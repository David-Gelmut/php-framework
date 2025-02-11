<?php

namespace App\MVC\Route;

class Route
{
    private static array $routes = [];

    public static function get(string $route, array $controller): RouteConfiguration
    {

        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routes[] = $routeConfiguration;
        return $routeConfiguration;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

}