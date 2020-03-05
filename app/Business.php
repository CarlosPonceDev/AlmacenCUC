<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function repairments()
    {
        return $this->hasMany(Repair::class);
    }
}
