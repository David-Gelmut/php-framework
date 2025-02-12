<?php

namespace App\MVC;

class Request
{
    public string $uri;

    public function __construct()
    {
        $this->uri = trim(urldecode($_SERVER["REQUEST_URI"]), '/');
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet(): bool
    {
        return $this->getMethod() == 'GET';
    }

    public function isPost(): bool
    {
        return $this->getMethod() == 'POST';
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    public function get($name, $default = null): ?string
    {
        return $_GET[$name] ?? $default;
    }

    public function post($name, $default = null): ?string
    {
        return $_POST[$name] ?? $default;
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    public function removeQueryString(): string
    {
        if ($this->uri) {
            $params = explode('?', $this->uri);
            return trim($params[0], '/');
        }
        return '';
    }

    public function getData(): array
    {
        $data = [];
        $requestData = $this->isGet() ? $_GET : $_POST;
        foreach ($requestData as $key => $value) {
            if (is_string($value)) {
                $value = trim($value);
            }
            $data[$key] = $value;
        }
        return $data;
    }
}