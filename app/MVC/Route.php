<?php

namespace App\MVC;

class Route
{
    private array $routes = [];
    private array $routeParams = [];

    public function __construct(protected Request $request, protected Response $response)
    {
    }


    public function add(string $path, \Closure|array $callback, string|array $method): self
    {
        $path = trim($path, '/');
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }
        $this->routes[] = [
            'path' => "/{$path}",
            'callback' => $callback,
            'middleware' => null,
            'method' => $method,
            'token' => true
        ];
        return $this;
    }

    public function get(string $path, \Closure|array $callback): self
    {
        return $this->add($path, $callback, 'GET');
    }

    public function post(string $path, \Closure|array $callback): self
    {
        return $this->add($path, $callback, 'POST');
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);
        if(!$route){
           $this->response->setResponseCode(404);
           echo 'Page not found';
           die();
        }
        if(is_array($route['callback'])){
            $route['callback'][0] = new $route['callback'][0];
        }
        return call_user_func($route['callback']);
    }

    private function matchRoute($path): array|bool
    {
        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", "/{$path}", $matches) &&
                in_array($this->request->getMethod(), $route['method'])) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->routeParams[$k] = $v;
                    }
                }
                return $route;
            }
        }
        return false;
    }
}