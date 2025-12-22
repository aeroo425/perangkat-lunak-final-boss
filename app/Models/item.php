<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Nama tabel (jika tidak default)
     * Hapus jika tabel kamu bernama "items"
     */
    protected $table = 'items';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal',
        'status',
        'foto',
        'user_id',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Default value jika kosong
     */
    protected $attributes = [
        'status' => 'hilang',
    ];

    /**
     * RELASI: Item dimiliki oleh User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper status (optional)
     */
    public function isHilang()
    {
        return $this->status === 'hilang';
    }

    public function isDitemukan()
    {
        return $this->status === 'ditemukan';
    }

    public function isDiklaim()
    {
        return $this->status === 'diklaim';
    }
}
