<?php

namespace App\MVC;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set(mixed $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(mixed $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(mixed $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(mixed $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function setFlash($key, $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }

    public function getFlash($key, $default = null): mixed
    {
        if (isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
        }
        return $value ?? $default;
    }


}