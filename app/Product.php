<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function observations()
    {
        return $this->hasMany(Observation::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
