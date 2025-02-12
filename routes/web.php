<?php

use App\Controllers\Http\HomeController;


route()->get('/', [\App\Controllers\Http\HomeController::class, 'index']);
route()->get('/login', [\App\Controllers\Http\UserController::class, 'login']);
route()->get('/register', [\App\Controllers\Http\UserController::class, 'register']);
route()->post('/register', [\App\Controllers\Http\UserController::class, 'store']);

/*route()->get('posts', [TestController::class, 'index']);
route()->post('test', [TestController::class, 'store']);
route()->get("/post/(?P<slug>[a-z0-9]+)", function () {
    return "post some";
});*/

//dump(route()->getRoutes());