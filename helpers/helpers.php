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

function route(): Route
{
    return app()->route;
}

function view(): View
{
    return app()->view;
}