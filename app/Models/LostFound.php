<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostFound extends Model
{
    use HasFactory;

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
        'user_id',
        'title',        // judul barang
        'description',  // deskripsi
        'image',        // foto barang
        'location',     // lokasi kehilangan / penemuan
        'contact',      // kontak pelapor
        'status',       // status: lost/found/resolved
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
