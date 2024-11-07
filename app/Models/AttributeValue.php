<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['value', 'attribute_id', 'color_code'];

    public function attribute()
    {
        $this->belongsTo(Attributes::class, 'attribute_id');
    }
}
