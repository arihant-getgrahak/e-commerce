<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    protected $fillable = [
        'name',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, AttributeValue::class, 'attribute_id', 'id', 'id', 'product_id');
    }
}
