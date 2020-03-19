<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function exits()
    {
        return $this->hasMany(Exits::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /*
    |--------------------------------------------------------------------------
    | LARATABLES
    |--------------------------------------------------------------------------
    */

    public static function laratablesCustomAction($product)
    {
        return view('inventory.components.buttons', compact('product'))->render();
    }

    public static function laratablesCustomDepartment($employee)
    {
        return $employee->department->description;
    }

    public static function laratablesSearchName($query, $searchValue)
    {
        return $query->orWhere('employees.name', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesSearchId($query, $searchValue)
    {
        return $query->orWhere('employees.id', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesSearchDepartment($query, $searchValue)
    {
        return $query->orWhere('departments.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderDepartment()
    {
        return 'departments.description';
    }

    public static function laratablesAdditionalColumns()
    {
        return ['department'];
    }
}
