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
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'currency',
        'razorpay_order_id',
        'delivery_date',
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
