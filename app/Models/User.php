<?php

namespace App\Models;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 8fdd84c8f2916a1539198c1935ba56070fa9f0b2
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> e7a250d36fffaa619ed974660d4f9300cf6c1f73
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
        'otp_code', // <-- TAMBAHKAN INI
        'otp_expires_at', // <-- TAMBAHKAN INI
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> e7a250d36fffaa619ed974660d4f9300cf6c1f73

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime', // <-- TAMBAHKAN INI
    ];
<<<<<<< HEAD
>>>>>>> 8fdd84c8f2916a1539198c1935ba56070fa9f0b2
=======
>>>>>>> e7a250d36fffaa619ed974660d4f9300cf6c1f73
}
