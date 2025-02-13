<?php

use App\MVC\Application;
use App\MVC\Database;
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

function db(): Database
{
    return app()->database;
}

function session(): \App\MVC\Session
{
    return app()->session;
}

function get_alerts(): void
{
    app()->view->getAlerts();
}

function get_errors(mixed $fieldName): string
{
    return app()->view->getErrors($fieldName);
}

function old(mixed $fieldName): string
{
    return isset(session()->get('form_data')[$fieldName]) ? prepare_field(session()->get('form_data')[$fieldName]) : '';
}

function prepare_field(string $str): string
{
    return strip_tags(htmlspecialchars($str, ENT_QUOTES));
}

function set_validation_class(string $fieldname): string
{
    $errors = session()->get('form_errors');
    if (empty($errors)) {
        return '';
    }
    return isset($errors[$fieldname]) ? 'border-red-500' : 'border-green-500';
}

/*function get_csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . session()->get('token') . '">';
}

function get_csrf_meta(): string
{
    return '<meta name="csrf-token" content="' . session()->get('token') . '">';
}*/

function get_csrf_token(): string
{
    return session()->get('csrf_token');
}

function env(string $key)
{

}