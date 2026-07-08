<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // Daftarkan kolom yang boleh diisi melalui Link::create()
    protected $fillable = [
        'user_id',
        'title',
        'url',
        'icon',
    ];
}