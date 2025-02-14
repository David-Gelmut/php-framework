<?php

define("ROOT", dirname(__DIR__));


const APP_DEBUG = true;
const SITE_URL = 'http://localhost:8000';

const APP = ROOT . '/app';
const CORE = ROOT . '/core';
const WWW = ROOT . '/public';
const LANG_DIR = ROOT . '/lang';
const VIEWS = ROOT . '/resources';
const LAYOUTS = ROOT . '/resources/layouts';
const RESOURCES = ROOT . '/resources';
const ERROR_LOGS = ROOT . '/tmp/errors/error.log';

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'php_frame_data',
    'username' => 'root',
    'password' => '12345',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'port' => 3306,
    'prefix' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
];

const MIDDLEWARE = [
    'auth' => \App\MVC\Middleware\Auth::class ,
    'guest' => \App\MVC\Middleware\Guest::class
];