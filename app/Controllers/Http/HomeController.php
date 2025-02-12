<?php

namespace App\Controllers\Http;

use App\MVC\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Home page'
        ]);
    }

}