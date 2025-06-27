<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $totalItems = Item::count();
        $totalSuppliers = Supplier::count();
        return view('livewire.dashboard.index', compact('totalItems', 'totalSuppliers'));
    }
}
