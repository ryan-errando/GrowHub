<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}

