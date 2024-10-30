<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAdress extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
