<?php

namespace App\Controllers\Http;

use App\Controllers\Controller;
use App\MVC\View;

class HomeController extends Controller
{
    public function index(): View|string
    {
        return view('home', [
            'title' => 'Home page'
        ]);
    }

    public function dashboard(): View|string
    {
        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }

}