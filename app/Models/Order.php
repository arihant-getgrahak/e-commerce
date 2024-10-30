<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'products',
        'address',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
