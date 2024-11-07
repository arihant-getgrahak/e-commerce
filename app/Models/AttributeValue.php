<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['value', 'attribute_id', 'color_code'];

    public function attribute()
    {
        return $this->belongsTo(Attributes::class, 'attribute_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute', 'attribute_value_id', 'product_id');
    }
}
