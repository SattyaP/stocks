<?php

namespace App\Livewire\ItemsLists;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $showModal = false;
    public $item_id, $supplier_id, $quantity, $note;
    public $status = 'available'; // 'available' or 'empty'

    public $image_url, $item_code, $item_name, $purchase_price, $unit;

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
        $this->reset(['image_url', 'item_code', 'item_name', 'purchase_price', 'unit', 'item_id', 'supplier_id', 'quantity', 'note', 'status']);
    }

    public function store()
    {
        $this->validate();

        $ifExists = Transaction::where('item_id', $this->item_id)->where('supplier_id', $this->supplier_id)->first();

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

        $this->reset(['supplier_id', 'quantity', 'note', 'status', 'item_id', 'image_url', 'item_code', 'item_name', 'purchase_price', 'unit']);
        $this->showModal = false;

        session()->flash('message', 'Transaction saved successfully.');
        $this->dispatch('refreshTransactionList');
    }

    public function detailItem()
    {
        $item = Item::find($this->item_id);

        if ($item) {
            $this->item_code = $item->item_code;
            $this->item_name = $item->item_name;
            $this->purchase_price = number_format((float)$item->purchase_price, 3, '.', '');
            $this->unit = $item->unit->unit_name;
            $this->image_url = $item->image;
        } else {
            $this->reset(['item_code', 'item_name', 'purchase_price', 'unit', 'image_url']);
        }
    }

    public function render()
    {
        $items = Item::with('unit')->get();
        $suppliers = Supplier::all();

        return view('livewire.items-lists.index', compact('items', 'suppliers'));
    }
}
