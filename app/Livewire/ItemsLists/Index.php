<?php

namespace App\Livewire\ItemsLists;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $showModal = false;
    public $item_id;
    public $supplier_id;
    public $quantity;
    public $note;
    public $status = 'available'; // 'available' or 'empty'

    protected $rules = [
        'supplier_id' => 'required|exists:suppliers,id',
        'quantity' => 'required|numeric|min:1',
        'note' => 'nullable|string|max:255',
        'status' => 'required|in:available,not available',
    ];

    public function open()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        $ifExists = Transaction::where('item_id', $this->item_id)
            ->where('supplier_id', $this->supplier_id)
            ->first();

        if ($ifExists) {
            session()->flash('error', 'Transaction already exists for this item and supplier.');
            return;
        }

        $transaction = new Transaction();
        $transaction->item_id = $this->item_id;
        $transaction->supplier_id = $this->supplier_id;
        $transaction->quantity = $this->quantity;
        $transaction->note = $this->note;
        $transaction->status = $this->status;

        $transaction->save();

        $this->reset(['supplier_id', 'quantity', 'note', 'status']);
        $this->showModal = false;

        session()->flash('message', 'Transaction saved successfully.');
        $this->dispatch('refreshTransactionList');
    }

    public function render()
    {
        $items = Item::with('unit')->get();
        $suppliers = Supplier::all();

        return view('livewire.items-lists.index', compact('items', 'suppliers'));
    }
}
