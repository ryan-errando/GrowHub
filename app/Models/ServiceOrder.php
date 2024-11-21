<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    
    protected $fillable = [
        'order_id',
        'service_id',
        'hours',
        'price_per_hour',
        'scheduled_start',
        'scheduled_end',
        'special_requests'
    ];

    protected $casts = [
        'scheduled_start' => 'datetime',
        'scheduled_end' => 'datetime',
        'price_per_hour' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
