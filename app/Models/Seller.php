<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Model;

class Seller extends Authenticable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'image'
    ];

    protected $hidden = [
        'password',
    ];

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

}
