<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    protected $fillable = [
        'order_id',
        'channel_order_id',
        'shipment_id',
        'courier_name',
        'status',
        'pickup_address_id',
        'actual_weight',
        'volumetric_weight',
        'platform',
        'charges',
    ];
}
