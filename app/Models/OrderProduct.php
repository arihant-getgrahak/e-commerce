<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
        'delivery_date',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->delivery_date = now()->addDays(14);
        });
    }

    protected $casts = [
        'delivery_date' => 'datetime:d-m-Y',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
