<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Exits;
use App\Exports\EntriesExport;
use App\Exports\ExitsExport;
use App\Exports\ProvidersExport;
use App\Product;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    public function entries(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date'
        ]);
        $entries = Entry::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new EntriesExport($entries), $today.'entradas.xlsx');
    }

    public function exits(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date'
        ]);
        $exits = Exits::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new ExitsExport($exits), $today.'salidas.xlsx');
    }

    public function providers(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date',
            'provider'      => 'required',
        ]);
        if ($request->input('provider') != 'all') {
            $provider = Provider::find($request->input('provider'));
            if (!$provider) {
                return abort('404');
            }
            $exits = Entry::where('provider_id', $provider->id)->whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        } else {
            $exits = Entry::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        }
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new ProvidersExport($exits), $today.'proveedores.xlsx');
    }
}
