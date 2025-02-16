<?php

route()->get('/', [\App\Controllers\Http\HomeController::class, 'index']);
route()->get('/dashboard', [\App\Controllers\Http\HomeController::class, 'dashboard'])->middleware(['auth']);
route()->get('/login', [\App\Controllers\Http\AuthController::class, 'login'])->middleware(['guest']);
route()->get('/logout', [\App\Controllers\Http\AuthController::class, 'logout'])->middleware(['auth']);
route()->post('/login', [\App\Controllers\Http\AuthController::class, 'auth'])->middleware(['guest']);
route()->get('/register', [\App\Controllers\Http\AuthController::class, 'register'])->middleware(['guest']);
route()->post('/register', [\App\Controllers\Http\AuthController::class, 'store'])->middleware(['guest']);

//dump(route()->getRoutes());