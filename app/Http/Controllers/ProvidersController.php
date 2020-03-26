<?php

namespace App\Http\Controllers;

use App\Provider;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('providers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider = new Provider();
        $provider->name = $request->input('name');
        $provider->save();
        return redirect()->route('proveedores.index')->with('status', '¡Proveedor agregado con éxito!');
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
        $provider = Provider::find($id);
        if (!$provider) {
            return abort('404');
        }
        return view('providers.edit', compact('provider'));
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
        $provider = Provider::find($id);
        if (!$provider) {
            return abort('404');
        }

        $provider->name = $request->input('name');
        $provider->save();
        return redirect()->route('proveedores.index')->with('status', '¡Proveedor editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return abort('404');
        }

        $provider->delete();
        return redirect()->route('proveedores.index')->with('status', '¡Proveedor eliminado con éxito!');
    }

    public function laratables()
    {
        return Laratables::recordsOf(Provider::class);
    }
}
