<?php

namespace App\Models;

use App\MVC\Model;

class User extends Model
{
  //  protected bool $timestamps = false;
    protected array $fillable = ['name', 'email', 'password'];
    protected array $rules = [
        'required' => [
            ['name'],
            ['email'],
            ['password'],
            ['confirmPassword']
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['password',8]
        ],
        'equals' => [
            ['password', 'confirmPassword']
        ]
    ];

    protected array $labels = [
        'name'=>'Имя'
    ];
}