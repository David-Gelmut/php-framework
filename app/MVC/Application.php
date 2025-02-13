<?php

namespace App\MVC;

class Application
{
    public static Application $app;
    public Request $request;
    public Route $route;
    public Response $response;
    public View $view;
    public Database $database;
    public Session $session;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->view = new View('default');
        $this->database = new Database();
        $this->session = new Session();
        $this->generateToken();
    }

    public function run(): void
    {
        echo $this->route->dispatch();
    }

    private function generateToken(): void
    {
        if (!session()->has('csrf_token')) {
            session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }
}