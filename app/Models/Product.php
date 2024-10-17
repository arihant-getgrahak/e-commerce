<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "description",
        "price",
        "stock",
        "parent_category_id",
        "child_category_id",
        "added_by",
    ];

    protected function casts(): array
    {
        return [
            "created_at" => "datetime:Y-m-d",
            "updated_at" => "datetime:Y-m-d",
        ];
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }

    public function parent()
    {
        return $this->belongsTo(ParentCategory::class, "parent_category_id");
    }
    public function children()
    {
        return $this->belongsTo(ChildCategory::class, "child_category_id");
    }

    public function meta(){
        return $this->hasMany(ProductMeta::class,"product_id");
    }
}
