<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
        'rtl',
        'default',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
