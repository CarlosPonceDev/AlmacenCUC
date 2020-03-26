<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewInventory extends Model
{
    protected $table = 'view_inventory';

    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesCustomObservations($product)
    {
        return view('inventory.components.observations', compact('product'))->render();
    }

    public static function laratablesCustomAction($product)
    {
        return view('inventory.components.buttons', compact('product'))->render();
    }
}
