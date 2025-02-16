<?php

namespace App\Controllers\Http;

use App\Controllers\Controller;
use App\Models\User;
use App\MVC\Auth;
use App\MVC\View;

class AuthController extends Controller
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

    public function auth(): void
    {
        $user = new User();
        if (!$user->validate([
                'required' => ['email', 'password']
            ]
        )) {
            session()->setFlash('error', 'Validation errors');
            response()->redirect();
        }

        $attributes = $user->getAttributesForm();
        $auth = Auth::login([
            'email' => $attributes['email'],
            'password' => $attributes['password']
        ]);

        if ($auth) {
            session()->setFlash('success', 'Thanks for your authorization.');
            response()->redirect('/dashboard');
        } else {
            session()->setFlash('error', 'Wrong email or pass');
            response()->redirect();
        }
    }

    public function logout(): void
    {
        logout();
        response()->redirect('/login');
    }
}