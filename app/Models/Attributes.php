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
        $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}
