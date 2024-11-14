<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCity extends Model
{
    protected $fillable = [
        'state_id',
        'country_id',
        'name',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(DeliveryState::class, 'state_id');
    }
}
