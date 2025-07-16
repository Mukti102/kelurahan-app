<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendudukRequest;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduks = Penduduk::with('alamat', 'keluarga', 'pendidikan', 'kesehatan')->get();
        return view('pages.admin.penduduk.index', compact('penduduks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendudukRequest $request)
    {
        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->store('penduduk', 'public');
            }
            $penduduk = Penduduk::create([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'status_penduduk' => $request->status_penduduk,
                'photo' => $photo,
            ]);

            $penduduk->alamat()->create([
                'alamat_sekarang' => $request->alamat_sekarang,
                'dusun' => $request->dusun,
                'telepon' => $request->telepon,
                'email' => $request->email,
            ]);

            $penduduk->perkawinan()->create([
                'status_perkawinan' => $request->status_perkawinan,
                'no_akta_nikah' => $request->no_akta_nikah,
                'no_akta_cerai' => $request->no_akta_cerai,
                'tanggal_nikah' => $request->tanggal_nikah,
                'tanggal_cerai' => $request->tanggal_cerai,
            ]);

            $penduduk->pendidikan()->create([
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'pekerjaan' => $request->pekerjaan,
            ]);

            $penduduk->kesehatan()->create([
                'golongan_darah' => $request->golongan_darah,
                'cacat' => $request->cacat,
                'asuransi_kesehatan' => $request->asuransi_kesehatan
            ]);

            $penduduk->keluarga()->create([
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'hubungan_keluarga' => $request->hubungan_keluarga,
            ]);
            Alert::success('Success', "Berhasil Menyimpan");
            return redirect()->route('penduduk.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        return view('pages.admin.penduduk.edit', compact('penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        try {
            $photo = $penduduk->photo;
            if ($request->hasFile('photo')) {
                Storage::delete($penduduk->photo);
                $photo = $request->file('photo')->store('penduduk', 'public');
            }
            $penduduk->update([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'status_penduduk' => $request->status_penduduk,
                'photo' => $photo,
            ]);

            $penduduk->alamat()->update([
                'alamat_sekarang' => $request->alamat_sekarang,
                'dusun' => $request->dusun,
                'telepon' => $request->telepon,
                'email' => $request->email,
            ]);

            $penduduk->perkawinan()->update([
                'status_perkawinan' => $request->status_perkawinan,
                'no_akta_nikah' => $request->no_akta_nikah,
                'no_akta_cerai' => $request->no_akta_cerai,
                'tanggal_nikah' => $request->tanggal_nikah,
                'tanggal_cerai' => $request->tanggal_cerai,
            ]);

            $penduduk->pendidikan()->update([
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'pekerjaan' => $request->pekerjaan,
            ]);

            $penduduk->kesehatan()->update([
                'golongan_darah' => $request->golongan_darah,
                'cacat' => $request->cacat,
                'asuransi_kesehatan' => $request->asuransi_kesehatan
            ]);

            $penduduk->keluarga()->update([
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'hubungan_keluarga' => $request->hubungan_keluarga,
            ]);

            Alert::success('Success', "Berhasil Mengedit");
            return redirect()->route('penduduk.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        try {
            if ($penduduk->photo) {
                Storage::delete($penduduk->photo);
            }
            Penduduk::destroy($penduduk->id);
            Alert::success('Success', "Berhasil Menghapus");
            return redirect()->route('penduduk.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }
}
