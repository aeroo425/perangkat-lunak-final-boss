<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostFound extends Model
{
    use HasFactory;

    protected $fillable = [

    'judul',
    'deskripsi',
    'lokasi',
    'tanggal',
    'status',
    'user_id',
    'foto', // ← WAJIB INI];

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
