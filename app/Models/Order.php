<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'total',
        'status', //Pending
        'payment_status', //Pending
        'payment_method', //default cod
        'transaction_id', //nullable for cod
        'currency', //default inr
        'razorpay_order_id', //nullable for cod
        'razorpay_payment_id', //nullable for cod
        'delivery_date', //default +14 days
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->delivery_date = now()->addDays(14);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(OrderAdress::class, 'address_id', 'id');
    }
}
