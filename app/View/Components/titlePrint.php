<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class titlePrint extends Component
{

    public $nomorSurat;
    /**
     * Create a new component instance.
     */
    public function __construct($nomorSurat)
    {
        // Pecah nomor surat untuk menambahkan padding pada angka
        $parts = explode('/', $nomorSurat);

        // Pastikan bagian pertama (angka) diberi padding hingga 3 digit
        if (isset($parts[0]) && is_numeric($parts[0])) {
            $parts[0] = str_pad($parts[0], 3, '0', STR_PAD_LEFT);
        }

        // Gabungkan kembali nomor surat
        $this->nomorSurat = implode('/', $parts);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.title-print');
    }
}
