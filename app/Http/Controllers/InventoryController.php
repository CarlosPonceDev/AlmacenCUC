<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entry;
use App\Exits;
use App\Inventory;
use App\Observation;
use App\Place;
use App\Product;
use App\Provider;
use App\Unit;
use App\ViewInventory;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.index');
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
        return view('inventory.create', compact(['categories', 'places', 'providers', 'units']));
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
            'date'          => 'required|date|date_format:Y-m-d',
            'description'   => 'required|string',
            'unit'          => 'required|string',
            'place'         => 'required|string',
            'category'      => 'required|string',
            'quantity'      => 'required|numeric',
            'minimum'       => 'required|numeric',
        ]);
        $unit = Unit::where('name', $request->input('unit'))->first();
        $place = Place::where('name', $request->input('place'))->first();
        $category = Category::where('name', $request->input('category'))->first();
        if ($unit && $place && $category) {
            $code = 0;
            $old_product = Product::where('category_id', $category->id)->orderBy('code', 'desc')->first();
            if ($old_product) {
                $code = $old_product->code;
            }

            $product = new Product();
            $product->code = $code + 1;
            $product->description = $request->input('description');
            $product->unit_id = $unit->id;
            $product->category_id = $category->id;
            $product->save();

            $inventory = new Inventory();
            $inventory->initial_stock = $request->input('quantity');
            $inventory->minimum = $request->input('minimum');
            $inventory->product_id = $product->id;
            $inventory->save();

            if (!isEmptyString($request->input('observations'))) {
                $observation = new Observation();
                $observation->description = $request->input('observations');
                $observation->product_id = $product->id;
                $observation->save();
            }
        } else {
            return abort('404');
        }
        return redirect()->route('inventario.index')->with('status', '¡Producto creado con éxito!');
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
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return abort('404');
        }
        $categories = Category::all();
        $places = Place::all();
        $providers = Provider::all();
        $units = Unit::all();
        return view('inventory.edit', compact(['product', 'categories', 'places', 'providers', 'units']));
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
        $request->validate([
            'description'   => 'required|string',
            'unit'          => 'required|string',
            'category'      => 'required|string',
            'quantity'      => 'required|numeric',
            'minimum'       => 'required|numeric',
        ]);
        $unit = Unit::where('name', $request->input('unit'))->first();
        $category = Category::where('name', $request->input('category'))->first();
        $product = Product::find($id);
        if ($unit && $category && $product) {
            if ($product->category->name != $category->name) {
                $code = 0;
                $old_product = Product::where('category_id', $category->id)->orderBy('code', 'desc')->first();
                if ($old_product) {
                    $code = $old_product->code;
                }

                $product->code = $code + 1;
                $product->category_id = $category->id;
            }

            $product->description = $request->input('description');
            $product->unit_id = $unit->id;
            $product->save();

            $inventory = $product->inventory;
            $inventory->initial_stock = $request->input('quantity');
            $inventory->minimum = $request->input('minimum');
            $inventory->save();
        } else {
            return abort('404');
        }
        return redirect()->route('inventario.index')->with('status', '¡Producto editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return abort('404');
        }
        $entries = Entry::where('product_id', $product->id)->get();
        $exits = Exits::where('product_id', $product->id)->get();
        $inventory = Inventory::where('product_id', $product->id)->get();
        $observations = Observation::where('product_id', $product->id)->get();
        $product->delete();
        foreach ($entries as $entry) {
            $entry->delete();
        }
        foreach ($exits as $exit) {
            $exit->delete();
        }
        foreach ($inventory as $invent) {
            $invent->delete();
        }
        foreach ($observations as $observation) {
            $observation->delete();
        }
        return redirect()->route('inventario.index')->with('status', '¡Producto eliminado con éxito!');
    }

    public function laratables()
    {
        return Laratables::recordsOf(ViewInventory::class);
    }

    public function category($category)
    {
        $category = Category::where('name', $category)->first();
        if (!$category) {
            return abort('404');
        }

        return view('inventory.index', compact('category'));
    }
}
