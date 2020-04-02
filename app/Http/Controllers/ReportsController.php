<?php

namespace App\Http\Controllers;

use App\Category;
use App\Employee;
use App\Entry;
use App\Exits;
use App\Exports\EmployeesExport;
use App\Exports\EntriesExport;
use App\Exports\ExitsExport;
use App\Exports\InventoryExport;
use App\Exports\ProvidersExport;
use App\Exports\RepairsExport;
use App\Product;
use App\Provider;
use App\Repair;
use App\ViewInventory;
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
        $providers = Provider::all();
        $employees = Employee::all();
        return view('reports.index', compact(['providers', 'employees']));
    }

    public function entries(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date',
            'product'       => 'required|string',
            'provider'      => 'required',
        ]);
        $start_date = $request->input('start-date') . ' 00:00:00';
        $end_date = $request->input('end-date') . ' 23:59:59';
        $entries = Entry::whereBetween('date', [$start_date, $end_date])->orderBy('date', 'DESC');
        if ($request->input('product') != 'all') {
            $category = Category::where('prefix', substr($request->input('product'), 0, 1))->first();
            if (!$category) {
                return abort('404');
            }
            $product = Product::where('code', substr($request->input('product'), 1))->where('category_id', $category->id)->first();
            if (!$product) {
                return abort('404');
            }
            $entries->where('product_id', $product->id);
        }
        if ($request->input('provider') != 'all') {
            $provider = Provider::find($request->input('provider'));
            if (!$provider) {
                return abort('404');
            }
            $entries->where('provider_id', $provider->id);
        }
        $entries = $entries->get();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new EntriesExport($entries), $today.'entradas.xlsx');
    }

    public function exits(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date',
            'product'       => 'required|string',
            'employee'      => 'required',
        ]);
        $start_date = $request->input('start-date') . ' 00:00:00';
        $end_date = $request->input('end-date') . ' 23:59:59';
        $exits = Exits::whereBetween('date', [$start_date, $end_date])->orderBy('date', 'DESC');
        if ($request->input('product') != 'all') {
            $category = Category::where('prefix', substr($request->input('product'), 0, 1))->first();
            if (!$category) {
                return abort('404');
            }
            $product = Product::where('code', substr($request->input('product'), 1))->where('category_id', $category->id)->first();
            if (!$product) {
                return abort('404');
            }
            $exits->where('product_id', $product->id);
        }
        if ($request->input('employee') != 'all') {
            $employee = Employee::find($request->input('employee'));
            if (!$employee) {
                return abort('404');
            }
            $exits->where('employee_id', $employee->id);
        }
        $exits = $exits->get();
        dd($exits);
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
            $entries = Entry::where('provider_id', $provider->id)->whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        } else {
            $entries = Entry::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        }
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new ProvidersExport($entries), $today.'proveedores.xlsx');
    }

    public function employees(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date',
            'employee'      => 'required',
        ]);
        if ($request->input('employee') != 'all') {
            $employee = Employee::find($request->input('employee'));
            if (!$employee) {
                return abort('404');
            }
            $exits = Exits::where('employee_id', $employee->id)->whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        } else {
            $exits = Exits::whereBetween('date', [$request->input('start-date'), $request->input('end-date')])->orderBy('date', 'DESC')->get();
        }
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new EmployeesExport($exits), $today.'empleados.xlsx');
    }

    public function repairs(Request $request)
    {
        $request->validate([
            'start-date'    => 'required|date',
            'end-date'      => 'required|date',
        ]);

        $repairs = Repair::whereBetween('exit_date', [$request->input('start-date'), $request->input('end-date')])->orderBy('exit_date', 'DESC')->get();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new RepairsExport($repairs), $today.'reparaciones.xlsx');
    }

    public function inventory()
    {
        $inventory = ViewInventory::all();
        $today = Carbon::now()->format('Y-m-d_H-i-a_');
        return Excel::download(new InventoryExport($inventory), $today.'reparaciones.xlsx');
    }
}
