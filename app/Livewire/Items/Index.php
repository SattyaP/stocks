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
    public $purchase_price = 0.0;
    public $image;
    public $unit_id;
    public $supplier_id;
    public $rules = [
        'item_name' => 'required|string|max:255',
        'purchase_price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,webp,png|max:2048', // 1MB Max
        'unit_id' => 'required|exists:units,id',
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
            $this->purchase_price = number_format((float)$item->purchase_price, 3, '.', '');
            $this->unit_id = $item->unit_id;
            $this->image = $item->image;
        } else {
            $this->mode = 'Add Item';
            $this->reset(['item_name', 'purchase_price', 'image', 'unit_id']);
            $this->item_code = strtoupper(uniqid('ITEM'));
        }

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->reset(['item_name', 'purchase_price', 'image', 'unit_id']);
    }

    public function mount()
    {
        $this->item_code = strtoupper(uniqid('ITEM'));
        $this->showModal = false;
    }

    public function store()
    {
        try {
            $this->validate();

            $item = new Item();
            $item->item_code = strtoupper(uniqid('ITEM'));
            $item->item_name = $this->item_name;
            $item->purchase_price = $this->purchase_price;
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
            $item->purchase_price = $this->purchase_price;
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
        $this->reset(['item_name', 'purchase_price', 'image', 'unit_id']);

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
        $items = Item::latest()->paginate(5);
        $suppliers = Supplier::all();
        $units = Unit::all();

        return view('livewire.items.index', compact('items', 'suppliers', 'units'));
    }
}
