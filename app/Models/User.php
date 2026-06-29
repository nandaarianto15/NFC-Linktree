<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

// Perubahan 1: Tambahkan 'profile_token' ke dalam Fillable attribute
#[Fillable(['name', 'email', 'password', 'profile_token', 'profile_photo_path', 'title', 'bio', 'phone', 'location'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        // Perubahan 2: WAJIB panggil parent::boot() agar internal Laravel berjalan normal
        parent::boot();

        static::creating(function ($user) {
            $user->profile_token = Str::random(10); // Membuat token acak 10 karakter
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
}