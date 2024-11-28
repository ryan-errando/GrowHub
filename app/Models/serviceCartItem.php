<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class serviceCartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'service_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
