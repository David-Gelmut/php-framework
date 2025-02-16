<?php

namespace App\Controllers\Api\V1;

use App\Models\User;

class UserController extends \App\Controllers\Controller
{
    public function index(): void
    {
        $users = db()->findAll('users');
        response()->jsonResponse(['status' => 'test', 'data' => $users]);

    }

    public function show(): void
    {
        $id = app()->route->routeParams['id'];
        $user = db()->findOrFail('users', $id);
        response()->jsonResponse(['status' => 'success', 'data' => $user]);
    }

    public function store(): void
    {
        $user = new User();
        if ($user_id = $user->create(request()->getData())) {
            response()->jsonResponse(['status' => 'success', 'data' => 'Создан пользователь с id = ' . $user_id]);
        } else {
            response()->jsonResponse(['status' => 'error', 'data' => 'Ошибка создания пользователя']);
        }
    }

    public function update(): void
    {
        $id = app()->route->routeParams['id'];
        $user = new User();
        if ($user_id = $user->update($id, request()->getData())) {
            response()->jsonResponse(['status' => 'success', 'data' => 'Обновлён пользователь с id = ' . $user_id]);
        } else {
            response()->jsonResponse(['status' => 'error', 'data' => 'Ошибка обновления пользователя с id = ' . $user_id]);
        }
    }

    public function updateForce(): void
    {
        $id = app()->route->routeParams['id'];
        $user = new User();
        if ($user_id = $user->updateForce($id, request()->getData())) {
            response()->jsonResponse(['status' => 'success', 'data' => 'Обновлён пользователь с id = ' . $user_id]);
        } else {
            response()->jsonResponse(['status' => 'error', 'data' => 'Ошибка обновления пользователя с id = ' . $user_id]);
        }
    }

    public function remove(): void
    {
        $id = app()->route->routeParams['id'];
        $user = new User();
        $resultUser  =  $user->find($id);
        if ($user_id = $resultUser->remove()) {
            response()->jsonResponse(['status' => 'success', 'data' => 'Удалён пользователь с id = ' . $user_id]);
        } else {
            response()->jsonResponse(['status' => 'error', 'data' => 'Ошибка удаления пользователя с id = ' . $id]);
        }
    }
}