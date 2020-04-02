<?php

namespace App\Exports;

use App\Entry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProvidersExport implements FromView
{
    private $entries = null;

    public function __construct($entries = null)
    {
        $this->entries = $entries;
    }

    public function view(): View
    {
        if ($this->entries == null) {
            $this->entries = Entry::all();
        }

        return view('reports.providers', [
            'entries' => $this->entries
        ]);
    }
}
