<?php

use App\Controllers\Http\HomeController;

route()->get('/', [\App\Controllers\Http\HomeController::class, 'index']);
route()->get('/dashboard', [\App\Controllers\Http\HomeController::class, 'dashboard'])->middleware(['auth']);
//route()->get('/users', [\App\Controllers\Http\UserController::class, 'index']);
route()->get('/login', [\App\Controllers\Http\UserController::class, 'login'])->middleware(['guest']);
route()->get('/register', [\App\Controllers\Http\UserController::class, 'register'])->middleware(['guest']);
route()->post('/register', [\App\Controllers\Http\UserController::class, 'store'])->middleware(['guest']);

//dump(route()->getRoutes());