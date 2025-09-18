<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Role extends Component
{
    /**
     * Create a new component instance.
     */
    public string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.role');
    }
}
