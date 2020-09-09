<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'exit_date', 'delivery_date'];
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


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesExitDate($repair)
    {
        return Carbon::parse($repair->exit_date)->format('Y-m-d');
    }

    public static function laratablesCustomAction($repair)
    {
        return view('repairs.components.buttons', compact('repair'))->render();
    }

    public static function laratablesDeliveryDate($repair)
    {
        if ($repair->delivery_date == null) {
            return '<i class="text-secondary">Aún en servicio</i>';
        }
        return Carbon::parse($repair->delivery_date)->format('Y-m-d');
    }

    public static function laratablesAdditionalColumns()
    {
        return ['personal', 'business', 'full_code'];
    }

    public static function laratablesCustomPersonal($repair)
    {
        return $repair->personal->name;
    }

    public static function laratablesOrderPersonal()
    {
        return 'personals.name';
    }

    public static function laratablesSearchPersonal($query, $searchValue)
    {
        return $query->orWhere('personals.name', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesCustomBusiness($repair)
    {
        return $repair->business->name;
    }

    public static function laratablesOrderBusiness()
    {
        return 'businesses.name';
    }

    public static function laratablesSearchBusiness($query, $searchValue)
    {
        return $query->orWhere('businesses.name', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesDescription($repair)
    {
        return $repair->product->description;
    }

    public static function laratablesOrderDescription()
    {
        return 'products.description';
    }

    public static function laratablesSearchDescription($query, $searchValue)
    {
        return $query->orWhere('products.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesCustomFullCode($repair)
    {
        return $repair->product->full_code;
    }

    public static function laratablesOrderRawFullCode($direction)
    {
        return 'categories.prefix ' . $direction . ', products.code ' . $direction;
    }

    public static function laratablesSearchFullCode($query, $searchValue)
    {
        return $query->orWhereRaw("CONCAT(categories.prefix, products.code) LIKE '%$searchValue%'");
    }
}
