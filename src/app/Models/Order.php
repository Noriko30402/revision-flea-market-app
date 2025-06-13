<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'purchase_date',
        'payment_method',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }

     // 取引に紐づくチャットメッセージ群を取得（1対多）
    public function messages()
    {
        return $this->hasMany(Message::class, 'order_id', 'id');
        // 'order_id' は messages テーブルの外部キー、'id' は orders テーブルの主キー
    }

}
