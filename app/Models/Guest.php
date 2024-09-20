<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guest extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id'];

    public function shoppingCart(): hasOne
    {
        return $this->hasOne(ShoppingCart::class, 'session_id', 'id');
    }
}
