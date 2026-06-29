<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['user_id', 'client_name', 'client_role', 'content', 'sort_order'];
}