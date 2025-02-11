<?php

namespace app\MVC\Route;

class RouteConfiguration
{
    private string $name;
    private string $middleware;

    public function __construct(
        public string $route, protected string $controller, protected string $action)
    {
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): self
    {
        $this->middleware = $middleware;
        return $this;
    }

}