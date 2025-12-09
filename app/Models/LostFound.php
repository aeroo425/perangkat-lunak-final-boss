<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostFound extends Model
{
    protected $fillable = [
         'judul',
    'nama_barang',
    'lokasi',
    'tanggal',
    'jenis',
    'deskripsi',
    'status',
    'gambar',
    'user_id'
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
