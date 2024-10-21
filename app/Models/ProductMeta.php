<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'size',
        "weight",
    ];

    protected function casts(): array
    {
        return [
            "created_at" => "datetime:Y-m-d",
            "updated_at" => "datetime:Y-m-d",
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
