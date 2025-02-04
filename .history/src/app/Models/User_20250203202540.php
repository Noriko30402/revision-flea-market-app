<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'postcode',
        'address',
        'building',
        'password',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    // public function favorites()
    // {
    //     return $this->hasMany(Favorite::class);
    // }


    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'favorites');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
