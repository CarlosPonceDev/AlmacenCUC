<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
