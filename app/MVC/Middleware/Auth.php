<?php

namespace App\MVC\Middleware;

class Auth
{
    public function handle(): void
    {
        if(!check_auth()){
            session()->setFlash('error','Авторизуйтесь');
            response()->redirect('/login');
        }
    }
}