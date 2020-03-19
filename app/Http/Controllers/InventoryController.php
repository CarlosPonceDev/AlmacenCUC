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

    public function create()
    {
        $categories = Category::all();
        $places = Place::all();
        $providers = Provider::all();
        $units = Unit::all();
        return view('inventory.create', compact(['categories', 'places', 'providers', 'units']));
    }

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
        return redirect()->route('inventario.index')->with('create', '¡Producto guardado con éxito!');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            Entry::where('product_id', $product->id)->delete();
            Exits::where('product_id', $product->id)->delete();
            Inventory::where('product_id', $product->id)->delete();
            Observation::where('product_id', $product->id)->delete();
            $product->delete();
            return redirect()->route('inventario.index')->with('destroy', '¡Producto eliminado con éxito!');
        }
        return abort('404');
    }

    public function laratables()
    {
        return Laratables::recordsOf(ViewInventory::class);
    }
}
