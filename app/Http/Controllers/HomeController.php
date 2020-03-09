<?php

namespace App\Http\Controllers;

use App\Category;
use App\Employee;
use App\Product;
use App\Provider;
use App\ViewMinimum;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products_count = Product::count();
        $employees_count = Employee::count();
        $providers_count = Provider::count();
        $categories_count = Category::count();
        return view('dashboard.index', compact(['products_count', 'employees_count', 'providers_count', 'categories_count']));
    }

    public function laratables()
    {
        return Laratables::recordsOf(ViewMinimum::class);
    }
}
