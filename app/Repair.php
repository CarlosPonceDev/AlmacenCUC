<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
