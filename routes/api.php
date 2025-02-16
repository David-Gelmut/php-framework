<?php

route()->get('/api/v1/users',[\App\Controllers\Api\V1\UserController::class,'index']);
route()->get('/api/v1/users/(?P<slug>[a-z0-9-])',[\App\Controllers\Api\V1\UserController::class,'show']);