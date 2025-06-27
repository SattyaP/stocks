<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $units = Unit::latest()->paginate(10);
        return view('livewire.units.index', compact('units'));
    }
}
