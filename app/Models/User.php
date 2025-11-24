<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_photo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
