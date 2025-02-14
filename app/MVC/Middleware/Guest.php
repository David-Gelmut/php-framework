<?php

namespace App\MVC\Middleware;

class Guest
{
    public function handle(): void
    {
        if(check_auth()){
            session()->setFlash('error','Вы авторизованы');
            response()->redirect('/');
        }
    }
}