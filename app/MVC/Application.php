<?php

namespace App\MVC;

use App\MVC\Route;
use App\MVC\Route\RouteDispatcher;

class Application
{
    public static Application $app;
    public Request $request;
    public Route $route;
    public Response $response;
    public View $view;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->view = new View('default');
    }

    public function run(): void
    {
        echo $this->route->dispatch();


        /* foreach (Route::getRoutes() as $routeConfiguration) {
             $routeDispatcher = new RouteDispatcher($routeConfiguration);
             $routeDispatcher->process();
         }*/
    }
}