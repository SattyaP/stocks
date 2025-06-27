<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card_readmore extends Component
{
    public $headline;
    public $description;
    public $route;

    public function __construct($headline, $description, $route)
    {
        $this->headline = $headline;
        $this->description = $description;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.card-readmore');
    }
}
