<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;

class Index extends Component
{

    public $unit_name;
    protected $rules = [
        'unit_name' => 'required|string|max:255',
    ];

    public function store()
    {
        $this->validate();

        Unit::create([
            'unit_name' => $this->unit_name,
        ]);

        session()->flash('message', 'Unit created successfully.');

        $this->reset(['unit_name']);
    }

    public function delete($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        session()->flash('message', 'Unit deleted successfully.');
    }

    public function render()
    {
        $units = Unit::latest()->paginate(10);
        return view('livewire.units.index', compact('units'));
    }
}
