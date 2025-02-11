<?php

namespace App\MVC\Route;

class RouteDispatcher
{

    private string $requestUri = '/';
    private array $paramMap = [];

    public function __construct(protected RouteConfiguration $routeConfiguration)
    {
    }

    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegex();
    }

    private function saveRequestUri()
    {
        if ($_SERVER["REQUEST_URI"] !== '/') {
            $this->requestUri = $this->clear($_SERVER["REQUEST_URI"]);
            $this->routeConfiguration->route = $this->clear($this->routeConfiguration->route);
        }


    }

    private function clear(string $string): string
    {
        return trim($string, '/');
    }

    private function setParamMap()
    {

        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $keyParam => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$keyParam] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    private function makeRegex()
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $value) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/',$requestUriArray);

    }
}