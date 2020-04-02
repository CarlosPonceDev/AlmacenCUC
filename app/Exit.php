<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exits extends Model
{
    use SoftDeletes;

    protected $table = 'exits';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date'];
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
    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesAdditionalColumns()
    {
        return ['code', 'description', 'unit', 'employee', 'place', 'observation'];
    }

    public static function laratablesDate($exit)
    {
        return $exit->date->format('Y-m-d');
    }

    public static function laratablesCustomCode($exit)
    {
        if (!$exit->product) {
            return null;
        }
        if (!$exit->product->category) {
            return null;
        }
        return $exit->product->category->prefix . $exit->product->code;
    }

    public static function laratablesSearchCode($query, $searchValue)
    {
        return $query->orWhere('categories.prefix', 'LIKE', '%' . substr($searchValue, 0, 1) . '%')
                    ->orWhere('products.code', 'LIKE', '%' . substr($searchValue, 1) . '%');
    }

    public static function laratablesRawOrderCode($direction)
    {
        return 'categories.prefix '.$direction.', products.code '.$direction;
    }

    public static function laratablesCustomDescription($exit)
    {
        if (!$exit->product) {
            return null;
        }
        return $exit->product->description;
    }
    
    public static function laratablesSearchDescription($query, $searchValue)
    {
        return $query->orWhere('products.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderDescription()
    {
        return 'products.description';
    }

    public static function laratablesCustomUnit($exit)
    {
        if (!$exit->unit) {
            return null;
        }
        return $exit->unit->description;
    }
    
    public static function laratablesSearchUnit($query, $searchValue)
    {
        return $query->orWhere('units.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderUnit()
    {
        return 'units.description';
    }

    public static function laratablesCustomEmployee($exit)
    {
        if (!$exit->employee) {
            return null;
        }
        return $exit->employee->name;
    }
    
    public static function laratablesSearchEmployee($query, $searchValue)
    {
        return $query->orWhere('employees.name', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderEmployee()
    {
        return 'employees.name';
    }

    public static function laratablesCustomPlace($exit)
    {
        if (!$exit->place) {
            return null;
        }
        return $exit->place->description;
    }
    
    public static function laratablesSearchPlace($query, $searchValue)
    {
        return $query->orWhere('places.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderPlace()
    {
        return 'places.description';
    }

    public static function laratablesCustomObservation($exit)
    {
        if (!$exit->observation) {
            return '<i class="text-secondary">N/A</i>';
        }
        return $exit->observation->description;
    }
    
    public static function laratablesSearchObservation($query, $searchValue)
    {
        return $query->orWhere('observations.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderObservation()
    {
        return 'observations.description';
    }

    public static function laratablesCustomAction($exit)
    {
        return view('exits.components.buttons', compact('exit'))->render();
    }
}
