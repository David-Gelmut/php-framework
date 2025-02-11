<?php

error_reporting(E_ALL);

if (APP_DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('error_log', __DIR__ . '/../tmp/log/php-errors.log');
}

require_once __DIR__ . '/../config/core.php';
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/helpers/helpers.php';
$app = new \App\MVC\Application();
require_once ROOT . '/routes/web.php';
require_once ROOT . '/routes/api.php';
$app->run();
