<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'search_keyword',
        'user_id',
        'count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
