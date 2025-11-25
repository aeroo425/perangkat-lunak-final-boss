<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['lost_found_id', 'user_id', 'isi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
