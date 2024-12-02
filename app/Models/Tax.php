<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'value',
        'type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
