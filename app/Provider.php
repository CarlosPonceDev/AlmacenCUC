<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
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
}
