<?php

namespace App\Http\Controllers;

use App\Category;
use App\Place;
use App\Employee;
use App\Exits;
use App\Observation;
use App\Product;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExitsController extends Controller
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
        $employees = Employee::all();
        $units = Unit::all();
        $places = Place::all();
        return view('exits.create', compact(['employees', 'units', 'places']));
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
            'code'          => 'required|string',
            'description'   => 'required|string',
            'quantity'      => 'required|numeric'
        ]);
        $employee = Employee::where('id', $request->input('employee'))->first();
        $unit = Unit::where('name', $request->input('unit'))->first();
        if (!$unit) {
            $unit = new Unit();
            $unit->name = replaceSpecialCharacters($request->input('unit'));
            $unit->description = $request->input('unit');
            $unit->save();
        }
        $place = Place::where('name', $request->input('place'))->first();
        $category = Category::where('prefix', substr($request->input('code'), 0, 1))->first();
        if ($employee && $unit && $place && $category) {
            if ($request->input('code') == null) {
                $product = Product::where('description', $request->input('description'))->first();
            } else {
                $product = Product::where('category_id', $category->id)->where('code', substr($request->input('code'), 1))->first();
            }
            if (!$product) {
                return abort('404');
            }

            $exit = new Exits();
            $exit->date = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
            $exit->quantity = $request->input('quantity');
            $exit->unit_id = $unit->id;
            $exit->place_id = $place->id;

            if (!isEmptyString($request->input('observations'))) {
                $observation = new Observation();
                $observation->description = $request->input('observations');
                $observation->product_id = $product->id;
                $observation->save();

                $exit->observation_id = $observation->id;
            }

            $exit->employee_id = $employee->id;
            $exit->product_id = $product->id;
            $exit->user_id = auth()->user()->id;
            $exit->save();
        } else {
            return abort('404');
        }
        return redirect()->route('salidas.create')->with('success', '¡Salida creada con éxito!');
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
