<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $fillable = [
        'user_id',
        'navigation_id',
        'parent_id',
        'name',
        'link',
    ];

    public function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id');
    }
}
