<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCart extends Model
{
    protected $fillable = ['session_id', 'product_id', 'quantity', 'price'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
        ];
    }
}
