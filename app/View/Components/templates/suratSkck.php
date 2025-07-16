<?php

namespace App\View\Components\templates;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class suratSkck extends Component
{

    public $surat;
    /**
     * Create a new component instance.
     */
    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.templates.surat-skck');
    }
}
