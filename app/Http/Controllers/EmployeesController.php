<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = Department::where('name', $request->input('department'))->first();
        if (!$department) {
            return abort('404');
        }

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->department_id = $department->id;
        $employee->save();

        return redirect()->route('empleados.index')->with('status', '¡Empleado creado con éxito!');
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
        $employee = Employee::find($id);
        if (!$employee) {
            return abort('404');
        }
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
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
        $employee = Employee::find($id);
        $department = Department::where('name', $request->input('department'))->first();
        if (!$department || !$employee) {
            return abort('404');
        }

        $employee->name = $request->input('name');
        $employee->department_id = $department->id;
        $employee->save();

        return redirect()->route('empleados.index')->with('status', '¡Empleado editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return abort('404');
        }

        $employee->delete();
        return redirect()->route('empleados.index')->with('status', '¡Empleado eliminado con éxito!');
    }

    public function laratables()
    {
        return Laratables::recordsOf(Employee::class, function ($query)
        {
            return $query->join('departments', 'employees.department_id', '=', 'departments.id')->select(['employees.*', 'departments.description']);
        });
    }
}
