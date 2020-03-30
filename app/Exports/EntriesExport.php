<?php

namespace App\Exports;

use App\Entry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EntriesExport implements FromView
{
    public function view(): View
    {
        return view('reports.entries', [
            'entries' => Entry::all()
        ]);
    }
}
