<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
