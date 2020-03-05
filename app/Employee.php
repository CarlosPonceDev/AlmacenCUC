<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function exits()
    {
        return $this->hasMany(Exits::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
