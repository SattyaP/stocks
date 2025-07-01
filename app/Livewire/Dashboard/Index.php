<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $totalItems = Item::count();
        $totalSuppliers = Supplier::count();
        $totalTransactions = 420000;

        return view('livewire.dashboard.index', compact('totalItems', 'totalSuppliers', 'totalTransactions'));
    }
}
