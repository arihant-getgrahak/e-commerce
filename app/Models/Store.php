<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
        'gst',
        'tax_value',
        'tax_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}