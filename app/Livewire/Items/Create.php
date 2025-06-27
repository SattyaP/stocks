<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $item_code;
    public $item_name;
    public $stock_quantity = 0;
    public $purchase_price = 0.00;
    public $image;
    public $unit_id;
    public $status = 'available';
    public $supplier_id;
    public $rules = [
        'item_name' => 'required|string|max:255',
        'stock_quantity' => 'required|integer|min:0',
        'purchase_price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,webp,png|max:1024', // 1MB Max
        'unit_id' => 'required|exists:units,id',
        'status' => 'required|in:available,empty',
    ];

    public function store() {
        try {
            $this->validate();

            $item = new Item();
            $item->item_code = strtoupper(uniqid('ITEM'));
            $item->item_name = $this->item_name;
            $item->stock_quantity = $this->stock_quantity;
            $item->purchase_price = $this->purchase_price;
            $item->status = $this->status;
            $item->unit_id = $this->unit_id;

            if ($this->image) {
                $imageName = Hash::make($this->image->getClientOriginalName());
                $this->image->storeAs('images/items', $imageName, 'public');
                $item->image = 'images/items/' . $imageName;
            }

            $item->save();

            session()->flash('message', 'Item created successfully.');
            return redirect()->route('items.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create item: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function submit_and_create()
    {
        $this->store();
        $this->reset(['item_name', 'stock_quantity', 'purchase_price', 'image', 'unit_id', 'status']);

        return redirect()->route('items.create');
    }

    public function render()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        return view('livewire.items.create', compact('suppliers', 'units'));
    }
}
