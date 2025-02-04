<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}

