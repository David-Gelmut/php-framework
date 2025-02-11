<?php

namespace App\Controllers\Http;

class TestController
{
    public function index()
    {
        return view()->render('test_view',['name'=>'test_data_view']);
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