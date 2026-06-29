<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['user_id', 'company', 'role', 'period', 'description', 'sort_order'];
}