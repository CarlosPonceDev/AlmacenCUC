<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
