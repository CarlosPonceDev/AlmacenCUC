<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
