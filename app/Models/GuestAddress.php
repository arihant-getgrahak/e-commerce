<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestAddress extends Model
{
    protected $fillable = [
        'session_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
    ];
}
