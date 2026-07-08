<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['name', 'email', 'password', 'profile_token', 'profile_photo_path', 'title', 'bio', 'phone', 'location', 'experience_years', 'headline', 'cta_description', 'resume_title'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->profile_token)) {
                $user->profile_token = Str::random(10);
            }
        });
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('sort_order');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class)->orderBy('sort_order');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class)->orderBy('sort_order');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class)->orderBy('sort_order');
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class)->orderBy('sort_order');
    }

    public function clients()
    {
        return $this->hasMany(Client::class)->orderBy('sort_order');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }
}