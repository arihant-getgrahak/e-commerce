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
        return $this->hasMany(DeliveryState::class, 'country_id');
    }

    public function city()
    {
        return $this->hasMany(DeliveryCity::class, 'country_id');
    }
}
