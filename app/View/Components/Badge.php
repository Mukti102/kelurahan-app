<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */

    public $status;
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge');
    }

    public function badgeClass()
    {
        return match ($this->status) {
            'sedang diproses' => 'bg-warning',
            'menunggu tanda tangan' => 'bg-info',
            'sudah dikonfirmasi' => 'bg-danger',
            default => 'bg-success',
        };
    }
}
