<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'postcode',
        'address',
        'building',
        'image',
        'user_id',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function ratingsReceived()
    {
    return $this->hasMany(Review::class, 'receiver_id');
    }

    public function averageRating()
    {
          if ($this->ratingsReceived->isEmpty()) {
        return 0;
    }
        return $average = $this->ratingsReceived->avg('stars');
    }

}
