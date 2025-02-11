<?php

namespace App\Controllers\Http;

class TestController
{
    public function index()
    {
        return view('test', ['name' => 'Tom', 'age' => 25]);
    }

    public function store()
    {
        echo 'store';
    }

    public function show()
    {
        echo 'show';
    }
}