<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class konfirmasi extends Component
{
    /**
     * Create a new component instance.
     */

    public $action;
    public $surat;
    public function __construct($action,$surat)
    {       
        $this->surat = $surat;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.konfirmasi');
    }
}
