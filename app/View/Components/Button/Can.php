<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Can extends Component
{
    public $permission;
    public $role;

    public function __construct(string $permission = null, string $role = null)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    public function render()
    {
        return view('components.button.can');
    }
}

