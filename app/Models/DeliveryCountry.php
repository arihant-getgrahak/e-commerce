<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCountry extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];
}
