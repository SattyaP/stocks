<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card_qty extends Component
{
    public $headline;
    public $description;
    public $value;
    public function __construct($headline, $description, $value) {
        $this->headline = $headline;
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.card_qty');
    }
}
