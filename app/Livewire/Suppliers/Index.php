<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    public $name_supplier, $address, $phone;

    protected $rules = [
        'name_supplier' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:15',
    ];

    public function store() {
        $this->validate();

        Supplier::create([
            'name_supplier' => $this->name_supplier,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Supplier created successfully.');

        $this->reset(['name_supplier', 'address', 'phone']);
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        session()->flash('message', 'Supplier deleted successfully.');
    }

    public function render()
    {
        $suppliers = Supplier::latest()->paginate(15);
        return view('livewire.suppliers.index', compact('suppliers'));
    }
}
