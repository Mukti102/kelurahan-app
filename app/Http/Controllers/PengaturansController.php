<?php

namespace App\Http\Controllers;

use App\Models\Pengaturans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.setting.index');
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
    public function show(Pengaturans $pengaturans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaturans $pengaturans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaturans $pengaturans, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'whatsapp' => 'nullable|string|max:255',
            'nama_lurah' => 'nullable|string|max:255',
            'nip_lurah' => 'nullable|string|max:255',
            'tanda_tangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kode_kelurahan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tentang' => 'nullable|string',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $pengaturan = Pengaturans::find($id);
    
        if (!$pengaturan) {
            return response()->json(['message' => 'Record not found'], 404);
        }
    
        if ($request->hasFile('logo')) {
            if (!empty($pengaturan->logo) && Storage::disk('public')->exists($pengaturan->logo)) {
                Storage::disk('public')->delete($pengaturan->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('logo', 'public');
        }
    
        if ($request->hasFile('tanda_tangan')) {
            if (!empty($pengaturan->tanda_tangan) && Storage::disk('public')->exists($pengaturan->tanda_tangan)) {
                Storage::disk('public')->delete($pengaturan->tanda_tangan);
            }
            $validatedData['tanda_tangan'] = $request->file('tanda_tangan')->store('tandaTangan', 'public');
        }
    
        if ($request->hasFile('hero_background')) {
            if (!empty($pengaturan->hero_background) && Storage::disk('public')->exists($pengaturan->hero_background)) {
                Storage::disk('public')->delete($pengaturan->hero_background);
            }
            $validatedData['hero_background'] = $request->file('hero_background')->store('hero_background', 'public');
        }
    
        $pengaturan->update($validatedData);
    
        Alert::success('Success', 'Data successfully updated!');
        return redirect()->route('pengaturan.index');
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaturans $pengaturans)
    {
        //
    }
}
