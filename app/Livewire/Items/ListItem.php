<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

#[On('refreshTransactionList')]
class ListItem extends Component
{
    public $in_count = 0;
    public $out_count = 0;
    public $filter_box = 'all';
    public $q = '';

    public function getTransactionsProperty()
    {
        if ($this->filter_box === 'all') {
            return Transaction::with(['item', 'supplier'])
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($this->filter_box === 'available') {
            return Transaction::with(['item', 'supplier'])
                ->where('status', 'available')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($this->filter_box === 'empty') {
            return Transaction::with(['item', 'supplier'])
                ->where('status', 'not available')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($this->q) {
            return Transaction::with(['item', 'supplier'])
                ->whereHas('item', function ($query) {
                    $query->where('item_name', 'like', "%{$this->q}%");
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function increaseStock($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $amount = (int) $this->in_count;

        if ($transaction && $amount > 0) {
            $transaction->increment('quantity', $amount);
            $this->dispatch('refreshTransactionList');
            $this->in_count = 0;
        } else {
            session()->flash('error', 'Invalid transaction or amount.');
        }
    }

    public function decreaseStock($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $amount = (int) $this->out_count;

        if ($transaction && $amount > 0) {
            if ($transaction->quantity >= $amount) {
                $transaction->decrement('quantity', $amount);
                if ($transaction->quantity == 0) {
                    $transaction->status = 'not available';
                    $transaction->save();
                }
                $this->dispatch('refreshTransactionList');
                $this->out_count = 0;
            } else {
                session()->flash('error', 'Insufficient stock to decrease.');
            }
        } else {
            session()->flash('error', 'Invalid transaction or amount.');
        }
    }

    public function filter()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if ($this->filter_box === 'all') {
            return Transaction::with(['item', 'supplier'])
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($this->filter_box === 'available') {
            return Transaction::with(['item', 'supplier'])
                ->where('status', 'available')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($this->filter_box === 'empty') {
            return Transaction::with(['item', 'supplier'])
                ->where('status', 'not available')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function search()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if ($this->q) {
            return Transaction::with(['item', 'supplier'])
                ->whereHas('item', function ($query) {
                    $query->where('item_name', 'like', '%' . $this->q . '%');
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            return Transaction::with(['item', 'supplier'])
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.items.list-item');
    }
}
