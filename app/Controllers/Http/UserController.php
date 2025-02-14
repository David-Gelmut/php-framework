<?php

namespace App\Controllers\Http;

use App\Models\User;
use App\MVC\Controller;
use App\MVC\Model;
use App\MVC\View;

class UserController extends Controller
{

    public function register(): View|string
    {
        return view('user/register', [
            'title' => 'Register page'
        ]);
    }

    public function store(): void
    {
        $user = new User();
        if (!$user->validate()) {
            session()->setFlash('error', 'Validation errors');
        } else {
            if ($id = $user->save()) {
                session()->setFlash('success', 'Thanks for registration. Your ID: ' . $id);
            } else {
                session()->setFlash('error', 'Error registration');
            };
        }
        response()->redirect('/register');
    }

    public function login(): View|string
    {
        return view('user/login', [
            'title' => 'Login page'
        ]);
    }

    public function index()
    {
        $user = new User();
    }
}