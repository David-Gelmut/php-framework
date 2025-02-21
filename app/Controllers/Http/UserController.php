<?php

namespace App\Controllers\Http;

use App\Controllers\Controller;
use App\MVC\Pagination;
use App\MVC\View;

class UserController extends Controller
{
    public function index(): View|string
    {
        $pagination = new Pagination(3,20,2);
        dump($pagination);
        dump($pagination->getOffset());
        $users = db()->findAll('users');
        return view('user/index', [
            'title' => 'Users',
            'users' => $users
        ]);
    }
}