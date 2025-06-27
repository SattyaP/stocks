<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $item_code;
    public $item_name;
    public $stock_quantity = 0;
    public $purchase_price = 0.0;
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

    public $showModal = false;

    public $mode = 'Add Item';

    public $selectedItemId = null;

    public function open($itemId = null, $mode = 'Add Item')
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if ($itemId) {
            $this->mode = $mode === 'View Item' ? 'View Item' : 'Edit Item';

            $item = Item::findOrFail($itemId);

            $this->selectedItemId = $item->id;
            $this->item_code = $item->item_code;
            $this->item_name = $item->item_name;
            $this->stock_quantity = $item->stock_quantity;
            $this->purchase_price = $item->purchase_price;
            $this->unit_id = $item->unit_id;
            $this->status = $item->status;
            $this->image = $item->image;
        } else {
            $this->mode = 'Add Item';
            $this->reset(['item_name', 'stock_quantity', 'purchase_price', 'image', 'unit_id', 'status']);
            $this->item_code = strtoupper(uniqid('ITEM'));
            $this->status = 'available';
        }

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->reset(['item_name', 'stock_quantity', 'purchase_price', 'image', 'unit_id', 'status']);
    }

    public function mount()
    {
        $this->item_code = strtoupper(uniqid('ITEM'));
        $this->status = 'available';
    }

    public function store()
    {
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
            $this->close();

            session()->flash('message', 'Item created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $this->validate();

            $item = Item::findOrFail($this->selectedItemId);
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
            $this->close();

            session()->flash('message', 'Item updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update item: ' . $e->getMessage());
        }
    }

    public function submit_and_create()
    {
        $this->store();
        $this->reset(['item_name', 'stock_quantity', 'purchase_price', 'image', 'unit_id', 'status']);

        return redirect()->route('items.create');
    }
    public function destroy($item_code)
    {
        try {
            $item = Item::where('item_code', $item_code)->firstOrFail();
            $item->delete();

            session()->flash('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete item: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $items = Item::latest()->paginate(15);
        $suppliers = Supplier::all();
        $units = Unit::all();

        return view('livewire.items.index', compact('items', 'suppliers', 'units'));
    }
}
