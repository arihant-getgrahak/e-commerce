<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryState extends Model
{
    protected $fillable = [
        'name',
        'country_id',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(DeliveryCountry::class, 'country_id');
    }
}
