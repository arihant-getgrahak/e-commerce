<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
        ];
    }
}
