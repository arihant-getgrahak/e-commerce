<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = [
        'parent_category_id',
        'name',
    ];

    public function parent(){
        return $this->belongsTo(ParentCategory::class,"parent_category_id");
    }
}
