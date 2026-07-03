<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['user_id', 'name', 'percentage', 'sort_order'];
}