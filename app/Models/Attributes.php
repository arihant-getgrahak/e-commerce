<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    protected $fillables = [
        'name',
    ];

    public function values()
    {
        $this->hasMany(attribute_value::class, 'attribute_id');
    }
}
