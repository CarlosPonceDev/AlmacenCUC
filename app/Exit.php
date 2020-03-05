<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exits extends Model
{
    protected $table = 'exits';
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
