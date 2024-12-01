<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'shop_id',
        'type',
        'total_amount',
        'status',
        'payment_status'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function serviceOrderItems()
    {
        return $this->hasMany(ServiceOrderItem::class);
    }
}
