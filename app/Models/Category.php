<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'in_home_banner',
        'in_menu',
        'order',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
