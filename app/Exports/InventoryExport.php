<?php

namespace App\Exports;

use App\ViewInventory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryExport implements FromView
{
    private $inventory = null;

    public function __construct($inventory = null)
    {
        $this->inventory = $inventory;
    }

    public function view(): View
    {
        if ($this->inventory == null) {
            $this->inventory = ViewInventory::all();
        }

        return view('reports.inventory', [
            'inventory' => $this->inventory
        ]);
    }
}
