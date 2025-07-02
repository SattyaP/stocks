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
        $totalItemRegistered = Item::count();
        $totalSuppliers = Supplier::count();
        $totalTransactions = Transaction::with('item')
            ->get()
            ->sum(function ($transaction) {
                if (!$transaction->item) {
                    return 0;
                }

                $price = str_replace('.', '', $transaction->item->purchase_price);
                return (float) $price * (float) $transaction->quantity;
            });

        $totalTransactions = 'Rp ' . number_format($totalTransactions, 0, ',', '.');

        $totalItemsTransaction = Transaction::with('item')
            ->get()
            ->sum(function ($transaction) {
                return $transaction->quantity;
            });

        return view('livewire.dashboard.index', compact('totalItemRegistered', 'totalSuppliers', 'totalTransactions', 'totalItemsTransaction'));
    }
}
