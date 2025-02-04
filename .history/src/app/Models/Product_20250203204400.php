<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id',
        'category_id',
        'condition_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    // public function favoriteBy()
    // {
    //     return $this->belongsToMany(User::class, 'favorites');
    // }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
