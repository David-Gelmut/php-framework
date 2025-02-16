<?php

namespace App\MVC;

class Auth
{
    public static function login(array $credentials): bool
    {
        $password = $credentials['password'];
        $field = array_key_first($credentials);
        $value = $credentials[$field];

        $user = db()->findOne('users', $value, $field);
        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            session()->set('user', [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name']
            ]);
            return true;
        }

        return false;
    }

    public static function getUser(): mixed
    {
        return session()->get('user');
    }

    public static function setUser(): void
    {
        if ($user_data = self::getUser()) {
            $user = db()->findOne('users', $user_data['id']);
            if ($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name']
                ]);
            }
        }
    }

    public static function isAuth(): bool
    {
        return session()->has('user');
    }

    public static function logout(): void
    {
        session()->remove('user');
    }
}