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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
