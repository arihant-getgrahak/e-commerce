<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCountry extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function state()
    {
        return $this->hasMany(DeliveryState::class);
    }

    public function city()
    {
        return $this->hasMany(DeliveryCity::class);
    }
}
