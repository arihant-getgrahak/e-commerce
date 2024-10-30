<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionOrder extends Model
{
    protected $fillable = [
        'session_id',
        'address_id',
        'total',
        'status', //Pending
        'payment_status', //Pending
        'payment_method', //default cod
        'transaction_id', //nullable for cod
        'currency', //default inr
        'razorpay_order_id', //nullable for cod
        'razorpay_payment_id', //nullable for cod
        'delivery_date', //default 14 days
    ];

    protected $casts = [
        'products' => 'array',
        'address' => 'array',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function products()
    {
        return $this->hasMany(GuestOrder::class, 'order_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(OrderAdress::class, 'address_id', 'id');
    }
}
