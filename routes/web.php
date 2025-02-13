<?php
use App\Controllers\Http\HomeController;

route()->get('/', [\App\Controllers\Http\HomeController::class, 'index'])->withoutToken();
route()->get('/users', [\App\Controllers\Http\UserController::class, 'index']);
route()->get('/login', [\App\Controllers\Http\UserController::class, 'login']);
route()->get('/register', [\App\Controllers\Http\UserController::class, 'register']);
route()->post('/register', [\App\Controllers\Http\UserController::class, 'store']);

//dump(route()->getRoutes());