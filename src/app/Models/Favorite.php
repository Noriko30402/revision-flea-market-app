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
        'item_id',
    ];

    // public function user()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    public function items()
    {
        return $this->hasMany(Item::class);
    }

}


