<?php

namespace App\Http\Controllers;

use App\Category;
use App\Employee;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class FetchsController extends Controller
{
    public function code(Request $request)
    {
        $code = $request->input('code');
        if (strlen($code) > 1) {
            $category = Category::where('prefix', substr($code, 0, 1))->first();
            if ($category) {
                $product = Product::with('category')->with('unit')->with('inventory')->where('code', substr($code, 1))->where('category_id', $category->id)->first();
                if ($product) {
                    return response()->json(['product' => $product]);
                }
            }
        }
        return null;
    }

    public function product(Request $request)
    {
        $products = Product::with('category')->with('unit')->with('inventory')->where('description', 'like', '%' . $request->input('search') . '%')->limit(10)->get();
        $response = [];
        foreach ($products as $product) {
            $response[] = [
                'label' => $product->description, 
                'value' => $product->description,
                'product' => $product,
            ];
        }
        return response()->json($response);
    }

    public function employees(Request $request)
    {
        $employees = Employee::where('name', 'like', '%' . $request->input('search') . '%')->limit(5)->get();
        $response = [];
        foreach ($employees as $employee) {
            $response[] = [
                'label' => $employee->name,
                'value' => $employee->name,
                'employee' => $employee,
            ];
        }
        return response()->json($response);
    }

    public function providers(Request $request)
    {
        $providers = Provider::where('name', 'like', '%' . $request->input('search') . '%')->limit(5)->get();
        $response = [];
        foreach ($providers as $provider) {
            $response[] = [
                'label' => $provider->name,
                'value' => $provider->name,
                'provider' => $provider,
            ];
        }
        return response()->json($response);
    }
}
