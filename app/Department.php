<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
