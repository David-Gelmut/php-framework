<?php

use App\Controllers\Http\TestController;

route()->add('/', function () {
    return 'hello';
}, ['post', 'get']);

route()->get('posts', [TestController::class, 'index']);
route()->post('test', [TestController::class, 'store']);
route()->get("/post/(?P<slug>[a-z0-9]+)", function () {
    return "post some";
});

//dump(route()->getRoutes());