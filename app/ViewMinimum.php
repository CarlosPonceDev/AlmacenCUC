<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewMinimum extends Model
{
    protected $table = 'minimum';

    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesRowClass($product)
    {
        return $product->total < 5 ? 'table-danger lead' : 'table-warning lead';
    }
    
    public static function laratablesCustomAction($product)
    {
        $color = 'warning';
        $message = 'Se está acabando el Stock';
        if ($product->total < 5) {
            $color = 'danger';
            $message = 'El Stock esta por terminar';
        }
        return view('dashboard.components.message', compact(['color', 'message']))->render();
    }
}
