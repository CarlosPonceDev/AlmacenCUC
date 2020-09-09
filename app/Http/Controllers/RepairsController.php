<?php

namespace App\Http\Controllers;

use App\Business;
use App\Personal;
use App\Product;
use App\Repair;
use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class RepairsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('repairs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personals = Personal::all();
        $businesses = Business::all();
        return view('repairs.create', compact(['personals', 'businesses']));
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
            'id'            => 'required|string',
            'product-id'    => 'required',
            'description'   => 'required|string',
            'personal'      => 'required',
            'business'      => 'required',
            'reason'        => 'required|string',
        ]);
        $product = Product::find($request->input('product-id'));
        $personal = Personal::where('id', $request->input('personal'))->orWhere('name', $request->input('personal'))->first();
        if (!$personal) {
            $personal = new Personal();
            $personal->name = $request->input('personal');
            $personal->save();
        }
        $business = Business::where('id', $request->input('business'))->orWhere('name', $request->input('business'))->first();
        if (!$business) {
            $business = new Business();
            $business->name = $request->input('business');
            $business->save();
        }

        if ($product && $personal && $business) {
            $repair = new Repair();
    
            $repair->exit_date      = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
            $repair->description    = "";
            $repair->product_id     = $product->id;
            $repair->personal_id    = $personal->id;
            $repair->business_id    = $business->id;
            $repair->reason         = $request->input('reason');
            $repair->user_id        = auth()->user()->id;
    
            $repair->save();
        } else {
            return abort('404');
        }

        return redirect()->route('reparaciones.index')->with('status', '¡Reparación creada con éxito!');
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
        $repair = Repair::find($id);
        if (!$repair) {
            return abort('404');
        }
        $personals = Personal::all();
        $businesses = Business::all();
        return view('repairs.edit', compact(['repair', 'personals', 'businesses']));
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
            'date'          => 'required|date|date_format:Y-m-d',
            'id'            => 'required|string',
            'product-id'    => 'required',
            'description'   => 'required|string',
            'personal'      => 'required',
            'business'      => 'required',
            'reason'        => 'required|string',
        ]);
        $repair = Repair::find($id);
        $product = Product::find($request->input('product-id'));
        $personal = Personal::where('id', $request->input('personal'))->orWhere('name', $request->input('personal'))->first();
        if (!$personal) {
            $personal = new Personal();
            $personal->name = $request->input('personal');
            $personal->save();
        }
        $business = Business::where('id', $request->input('business'))->orWhere('name', $request->input('business'))->first();
        if (!$business) {
            $business = new Business();
            $business->name = $request->input('business');
            $business->save();
        }

        if ($product && $personal && $business) {
            $repair->exit_date      = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
            $repair->description    = "";
            $repair->product_id     = $product->id;
            $repair->personal_id    = $personal->id;
            $repair->business_id    = $business->id;
            $repair->reason         = $request->input('reason');
            $repair->user_id        = auth()->user()->id;
    
            $repair->save();
        } else {
            return abort('404');
        }

        return redirect()->route('reparaciones.index')->with('status', '¡Reparación editada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repair = Repair::find($id);
        if (!$repair) {
            return abort('404');
        }

        $repair->delete();

        return redirect()->route('reparaciones.index')->with('status', '¡Reparación eliminada con éxito!');
    }

    public function delivery(Request $request)
    {
        $repair = Repair::find($request->input('id'));
        if (!$repair) {
            return abort('404');
        }
        $repair->delivery_date = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
        $repair->save();

        return redirect()->route('reparaciones.index')->with('status', '¡Reparación entregada con éxito!');
    }

    public function laratables()
    {
        return Laratables::recordsOf(Repair::class, function ($query)
        {
            return $query->join('personals', 'repairs.personal_id', '=', 'personals.id')
                        ->join('businesses', 'repairs.business_id', '=', 'businesses.id')
                        ->join('products',   'repairs.product_id',  '=', 'products.id')
                        ->join('categories', 'products.category_id','=', 'categories.id')
                        ->select(['repairs.*', 'personals.name', 'businesses.name', 'products.description', 'products.code', 'categories.prefix']);
        });
    }
}
