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
        return $product->total == 0 ? 'table-danger lead' : 'table-warning lead';
    }
    
    public static function laratablesCustomAction($product)
    {
        $color = 'warning';
        $message = 'Se está acabando el Stock';
        if ($product->total == 0) {
            $color = 'danger';
            $message = 'Se terminó el Stock';
        }
        return view('dashboard.components.message', compact(['color', 'message']))->render();
    }
}
