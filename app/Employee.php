<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
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
