<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAdress extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
