<?php

namespace App\Http\Controllers;

use App\Place;
use App\Provider;
use App\Category;
use App\Unit;
use App\Entry;
use App\Inventory;
use App\Observation;
use App\Product;
use App\ViewInventory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $places = Place::all();
        $providers = Provider::all();
        $units = Unit::all();
        return view('entries.create', compact(['categories', 'places', 'providers', 'units']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'bill'  => 'required|string'
        ]);
        $category = Category::where('name', $request->input('category'))->first();
        $unit = Unit::where('name', $request->input('unit'))->first();
        $place = Place::where('name', $request->input('place'))->first();
        $provider = Provider::where('id', $request->input('provider'))->first();
        if ($category && $unit && $place && $provider) {
            if ($request->input('code') == null || !Product::where('description', $request->input('description'))->first()) {
                $request->validate([
                    'description'  => 'required|string'
                ]);

                $code = Product::where('category_id', $category->id)->orderBy('code', 'desc')->first()->code;
                $product = new Product;
                $product->code = $code + 1;
                $product->description = $request->input('description');
                $product->unit_id = $unit->id;
                $product->category_id = $category->id;
                $product->save();

                $inventory = new Inventory();
                $inventory->initial_stock = 0;
                if (isEmptyString($request->input('minimum'))) {
                    $inventory->minimum = 0;
                } else {
                    $inventory->minimum = $request->input('minimum');
                }
                $inventory->product_id = $product->id;
                $inventory->save();
            } else {
                $request->validate([
                    'description'  => 'required|string'
                ]);

                if ($request->input('code') == null) {
                    $product = Product::where('description', $request->input('description'))->first();
                } else {
                    $product = Product::where('category_id', $category->id)->where('code', substr($request->input('code'), 1))->first();
                }
                if (!$product) {
                    return abort('404');
                }
            }

            $entry = new Entry();
            $entry->date = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
            $entry->quantity = $request->input('quantity');
            $entry->bill = $request->input('bill');
            $entry->unit_id = $unit->id;
            $entry->place_id = $place->id;

            if (!isEmptyString($request->input('observations'))) {
                $observation = new Observation();
                $observation->description = $request->input('observations');
                $observation->product_id = $product->id;
                $observation->save();

                $entry->observation_id = $observation->id;
            }

            $entry->provider_id = $provider->id;
            $entry->product_id = $product->id;
            $entry->user_id = auth()->user()->id;
            $entry->save();
        } else {
            return abort('404');
        }
        return redirect()->route('entradas.create')->with('success', '¡Entrada guardada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
