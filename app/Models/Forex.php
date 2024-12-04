<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forex extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'code',
        'symbol',
        'exchange',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
