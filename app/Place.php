<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
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
}
