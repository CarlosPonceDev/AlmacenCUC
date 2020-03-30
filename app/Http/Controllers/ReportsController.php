<?php

namespace App\Http\Controllers;

use App\Exports\EntriesExport;
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

    public function entries()
    {
        $today = Carbon::now()->format('Y-m-d_H:i:s_');
        return Excel::download(new EntriesExport, $today.'entradas.xlsx');
    }
}
