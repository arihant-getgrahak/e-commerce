<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        "name",
        "rating",
        "email",
        "comment",
        "product_id"
    ];
}
