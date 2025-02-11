<?php

namespace App\MVC;

class View
{
    public string $content = '';

    public function __construct(public string $layout)
    {
    }

    public function render($view, $data = [], $layout = '')
    {
        dump($view, $data);
    }
}