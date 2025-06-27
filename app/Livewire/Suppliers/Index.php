<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $suppliers = Supplier::latest()->paginate(15);
        return view('livewire.suppliers.index', compact('suppliers'));
    }
}
