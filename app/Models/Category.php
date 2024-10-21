<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "parent_id"
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    public function child()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    protected function casts(): array
    {
        return [
            "created_at" => "datetime:Y-m-d",
            "updated_at" => "datetime:Y-m-d",
        ];
    }

}
