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
        if (!$route) {
            abort('Page not found');
        }
        if (is_array($route['callback'])) {
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
                if (request()->isPost()) {
                    if ($route['token'] && !$this->checkCsrfToken()) {
                        if (request()->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'Access error'
                            ]);
                            die();
                        } else {
                            abort('Page expired', 419);
                        }
                    }
                }
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

    public function checkCsrfToken(): bool
    {
        $token = request()->post('token');
        return $token && $token == session()->get('csrf_token');
    }

    public function withoutToken(): self
    {
        $this->routes[array_key_last($this->routes)]['token'] = false;
        return $this;
    }
}