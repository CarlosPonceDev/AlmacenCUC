<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | CUSTOM ATTRIBUTES
    |--------------------------------------------------------------------------
    */
    public function getFullCodeAttribute()
    {
        return $this->category->prefix . $this->code;
    }

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
