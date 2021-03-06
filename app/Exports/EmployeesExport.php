<?php

namespace App\Exports;

use App\Exits;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeesExport implements FromView
{
    private $exits = null;

    public function __construct($exits = null)
    {
        $this->exits = $exits;
    }

    public function view(): View
    {
        if ($this->exits == null) {
            $this->exits = Exits::all();
        }

        return view('reports.employees', [
            'exits' => $this->exits
        ]);
    }
}
