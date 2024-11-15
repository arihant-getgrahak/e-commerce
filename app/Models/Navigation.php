<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function menus()
    {
        return $this->hasMany(NavigationMenu::class);
    }
}
