<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $table = 'inventory';
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function exits()
    {
        return $this->hasMany(Exits::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
