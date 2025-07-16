<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimoni = Testimoni::all();
        return view('pages.admin.masterdata.testimoni.index', compact('testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.masterdata.testimoni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'testimoni' => 'required',
                'jabatan' => 'required',
                'avatar'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nama.required' => 'Nama Lengkap wajib diisi',
                'testimoni.required' => 'Testimoni wajib diisi',
                'jabatan.required' => 'Jabatan wajib diisi',
                'avatar.required' => 'Avatar wajib diisi',
                'avatar.image' => 'Avatar harus berupa gambar',
                'avatar.mimes' => 'Avatar harus berupa jpeg, png, jpg, gif, svg',
                'avatar.max' => 'Avatar maximal 2048kb',
            ]
        );

        if ($validate->fails()) {
            return redirect()->route('testimoni.create')
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->hasFile('avatar')) {
            $avatarpath = $request->file('avatar')->store('avatar', 'public');
        }

        Testimoni::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'testimoni' => $request->testimoni,
            'avatar' => $avatarpath,
        ]);

        Alert::success('Success', 'Testimoni Berhasil Dibuat');
        return redirect()->route('testimoni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        return view('pages.admin.masterdata.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'testimoni' => 'required|string',
        ]);

        if ($validate->fails()) {
            return redirect()->route('testimoni.edit', $testimoni->id)
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->hasFile('avatar')) {
            if ($testimoni->avatar) {
                Storage::disk('public')->delete($testimoni->avatar);
            }
            $avatarpath = $request->file('avatar')->store('avatar', 'public');
        }

        $testimoni->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'testimoni' => $request->testimoni,
            'avatar' => isset($avatarpath) ? $avatarpath : $testimoni->avatar,
        ]);

        Alert::success('Success', 'Testimoni Berhasil Diupdate');
        return redirect()->route('testimoni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {

        if ($testimoni->avatar) {
            Storage::disk('public')->delete($testimoni->avatar);
        }

        $testimoni->delete();

        Alert::success('Success', 'Testimoni Berhasil Dihapus');
        return redirect()->route('testimoni.index');
    }
}
