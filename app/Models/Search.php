<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'search_keyword',
        'count',
        'user_id',
        'session_id',
    ];
}
