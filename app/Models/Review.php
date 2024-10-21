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

    protected function casts(): array
    {
        return [
            "created_at" => "datetime:Y-m-d",
            "updated_at" => "datetime:Y-m-d",
        ];
    }

}
