<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['status', 'order_id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
