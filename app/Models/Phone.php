<?php

namespace App\Models;

use App\MVC\Model;

class Phone extends Model
{
    protected array $fillable = ['phone_number', 'user_id'];
    protected array $rules = [
        'required' => [
            ['phone_number'],
            ['user_id'],
        ]
    ];
}