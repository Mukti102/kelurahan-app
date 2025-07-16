<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class AlgorytmanDpsFifoController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Mengambil surat berdasarkan Dynamic Priority Scheduling
        $lettersDps = Letter::with('letterType')->dynamicPriority()->get();

        // Mengambil surat berdasarkan First In First Out
        $lettersFifo = Letter::with('letterType')->firstInFirstOut()->get();

        if (auth()->user()->role == 'admin') {
            // Contoh: Menggabungkan hasil
            $surats = $lettersDps->merge($lettersFifo)
                ->filter(function ($item) {
                    return $item->status != 'selesai';
                });
        } else {
            $surats = $lettersDps->merge($lettersFifo)
                ->filter(function ($item) {
                    return $item->status != 'selesai' && $item->status == 'menunggu tanda tangan';
                });
        }

        return view('pages.admin.surat-masuk.dpsfifo', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
