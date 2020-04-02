<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

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

    public function provider()
    {
        return $this->belongsTo(Provider::class);
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
        return ['code', 'description', 'unit', 'provider', 'place', 'observation'];
    }

    public static function laratablesDate($entry)
    {
        return $entry->date->format('Y-m-d');
    }

    public static function laratablesCustomCode($entry)
    {
        if (!$entry->product) {
            return null;
        }
        if (!$entry->product->category) {
            return null;
        }
        return $entry->product->category->prefix . $entry->product->code;
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

    public static function laratablesCustomDescription($entry)
    {
        if (!$entry->product) {
            return null;
        }
        return $entry->product->description;
    }
    
    public static function laratablesSearchDescription($query, $searchValue)
    {
        return $query->orWhere('products.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderDescription()
    {
        return 'products.description';
    }

    public static function laratablesCustomUnit($entry)
    {
        if (!$entry->unit) {
            return null;
        }
        return $entry->unit->description;
    }
    
    public static function laratablesSearchUnit($query, $searchValue)
    {
        return $query->orWhere('units.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderUnit()
    {
        return 'units.description';
    }

    public static function laratablesCustomProvider($entry)
    {
        if (!$entry->provider) {
            return null;
        }
        return $entry->provider->name;
    }
    
    public static function laratablesSearchProvider($query, $searchValue)
    {
        return $query->orWhere('providers.name', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderProvider()
    {
        return 'providers.name';
    }

    public static function laratablesCustomPlace($entry)
    {
        if (!$entry->place) {
            return null;
        }
        return $entry->place->description;
    }
    
    public static function laratablesSearchPlace($query, $searchValue)
    {
        return $query->orWhere('places.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderPlace()
    {
        return 'places.description';
    }

    public static function laratablesCustomObservation($entry)
    {
        if (!$entry->observation) {
            return '<i class="text-secondary">N/A</i>';
        }
        return $entry->observation->description;
    }
    
    public static function laratablesSearchObservation($query, $searchValue)
    {
        return $query->orWhere('observations.description', 'LIKE', '%' . $searchValue . '%');
    }

    public static function laratablesOrderObservation()
    {
        return 'observations.description';
    }

    public static function laratablesCustomAction($entry)
    {
        return view('entries.components.buttons', compact('entry'))->render();
    }
}
