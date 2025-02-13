<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
/*if (APP_DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('error_log',  dirname(__DIR__) . '/tmp/errors/error.log');
}*/
require_once __DIR__ . '/../config/core.php';
require_once ROOT . '/vendor/autoload.php';

$whoops = new \Whoops\Run();
if (APP_DEBUG) {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function (Throwable $e) {
        error_log("[" . date('Y-m-d H:i:s') . "]  
        Error: {$e->getMessage()}" . PHP_EOL.
        "File: {$e->getFile()}" . PHP_EOL.
        "Line: {$e->getLine()}" . PHP_EOL.
            "=======================================".PHP_EOL, 3, ERROR_LOGS);
        abort('Error', 500);
    }));
}
$whoops->register();
require_once ROOT . '/helpers/helpers.php';
$app = new \App\MVC\Application();
require_once ROOT . '/routes/web.php';
require_once ROOT . '/routes/api.php';
$app->run();
