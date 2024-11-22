<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{
    protected $fillable = [
        'user_id',
        'tag',
        'name',
        'email',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
