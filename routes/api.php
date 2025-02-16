<?php

route()->get('/api/v1/users',[\App\Controllers\Api\V1\UserController::class,'index']);
route()->get('/api/v1/users/(?P<id>[0-9-]+)',[\App\Controllers\Api\V1\UserController::class,'show']);
route()->post('/api/v1/users',[\App\Controllers\Api\V1\UserController::class,'store'])->withoutToken();
route()->patch('/api/v1/users/(?P<id>[0-9-]+)',[\App\Controllers\Api\V1\UserController::class,'update'])->withoutToken();
route()->put('/api/v1/users/(?P<id>[0-9-]+)',[\App\Controllers\Api\V1\UserController::class,'updateForce'])->withoutToken();
route()->delete('/api/v1/users/(?P<id>[0-9-]+)',[\App\Controllers\Api\V1\UserController::class,'remove'])->withoutToken();