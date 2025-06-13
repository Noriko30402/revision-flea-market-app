<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'sender_id',
        'receiver_id',
        'stars',
        'reviewed',
    ];


public function ratedBy()
{
    return $this->belongsTo(Profile::class, 'sender_id');
}

public function receivedUser()
{
    return $this->belongsTo(Profile::class, 'receiver_id');
}


}
