<?php

namespace App\Controllers\Api\V1;

use App\Models\User;

class UserController extends \App\Controllers\Controller
{
    public function index()
    {

        $users = db()->findAll('users');
        response()->jsonResponse(['status' => 'test', 'data' => $users]);
        //return 'index api';
    }

    public function show()
    {
        return 'show api';
    }
}