<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Exports\EntriesExport;
use App\Product;
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
            'end-date'    => 'required|date'
        ]);
        $entries = Entry::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new EntriesExport($entries), $today.'entradas.xlsx');
    }
}
