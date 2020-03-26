<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesCustomAction($provider)
    {
        return view('providers.components.buttons', compact('provider'))->render();
    }
}
