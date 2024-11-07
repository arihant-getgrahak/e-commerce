<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'added_by',
        'brand_id',
        'slug',
        'thumbnail',
        'cost_price',
        'sku',
        'weight',
        'attributes',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
        ];
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class, 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'products_attribute', 'product_id', 'attribute_value_id');
    }
}
