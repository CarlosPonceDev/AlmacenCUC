<?php

namespace App\Exports;

use App\Repair;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RepairsExport implements FromView
{
    private $repairs = null;

    public function __construct($repairs = null)
    {
        $this->repairs = $repairs;
    }

    public function view(): View
    {
        if ($this->repairs == null) {
            $this->repairs = Repair::all();
        }

        return view('reports.repairs', [
            'repairs' => $this->repairs
        ]);
    }
}
