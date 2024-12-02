<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price_per_hour',
        'minimum_hours',
        'maximum_hours',
        'is_available',
        'image'
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    
}
