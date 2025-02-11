<?php

use App\MVC\Application;
use App\MVC\Request;
use App\MVC\Route;
use App\MVC\View;

function app(): Application
{
    return Application::$app;
}


function request(): Request
{
    return app()->request;
}

function response(): \App\MVC\Response
{
    return app()->response;
}

function route(): Route
{
    return app()->route;
}

function view(string $view = '', $data = [], $layout = ''): View|string
{
    if ($view) {
        return app()->view->render($view, $data, $layout);
    }
    return app()->view;
}

function abort(string $error, int $code = 404): void
{
    response()->setResponseCode($code);
    echo view("errors/{$code}", ['error' => $error], false);
    die();
}

function base_url($path = ''): string
{
    return ROOT . $path;
}