<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Exits;
use App\Inventory;
use App\Observation;
use App\Product;
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

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            Entry::where('product_id', $product->id)->delete();
            Exits::where('product_id', $product->id)->delete();
            Inventory::where('product_id', $product->id)->delete();
            Observation::where('product_id', $product->id)->delete();
            $product->delete();
            return redirect()->route('inventario.index')->with('delete', '¡Producto eliminado con éxito!');
        }
        return abort('404');
    }

    public function laratables()
    {
        return Laratables::recordsOf(ViewInventory::class);
    }
}
