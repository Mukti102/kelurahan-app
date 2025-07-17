<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterMiskin;
use App\Models\LetterPengantarNikah;
use App\Models\LetterTanah;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LetterTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $surats = LetterTanah::with('letter')
            ->whereHas('letter', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        if ($user->role == 'admin') {
            $surats = LetterTanah::with('letter')->whereHas('letter', function ($query) {
                $query->where('status', '!=', 'selesai');
            })->get();
            return view('pages.admin.surat-masuk.SPPFBT.index', compact('surats'));
        } elseif ($user->role == 'lurah') {
            $surats = LetterTanah::with('letter')
                ->whereHas('letter', function ($query) {
                    $query->where('status', 'menunggu tanda tangan');
                })
                ->get();
            return view('pages.lurah.SPPFBT.index', compact('surats'));
        } else {
            return view('pages.masyarakat.SPPFBT.index', compact('surats'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.masyarakat.SPPFBT.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $user = Auth::user();

        try {
            DB::transaction(function () use ($request, $validated, $user) {
                // Simpan data tanah ke database
                $letterTanah = LetterTanah::create($validated);

                $filesMeta = $this->storeFiles($request);

                $letter = new Letter([
                    'user_id'   => $user->id,
                    'priority' => 0,
                    'status' => 'sedang diproses',
                    'berkas' => $filesMeta,
                ]);
                $letterTanah->letter()->save($letter);
            });

            Alert::success('Success', 'Data berhasil di kirim');

            // Mengalihkan user ke halaman yang diinginkan setelah berhasil menyimpan data
            return redirect()->route('surat-pernyataan-penguasaan-tanah.index')->with('success', 'Data berhasil disimpan');
        } catch (\Illuminate\Database\QueryException $e) {
            FacadesLog::info("error Create surat Tanah", ['message' => $e->getMessage()]);
            Alert::error('Error', $e->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterTanah $letterTanah, $id)
    {
        $auth = Auth::user();
        $surat = LetterTanah::find(decrypt($id));
        if ($auth->role == 'admin') {
            return view('pages.admin.surat-masuk.SPPFBT.show', compact('surat'));
        } elseif ($auth->role == 'lurah') {
            return view('pages.lurah.SPPFBT.show', compact('surat'));
        }
    }

    public function konfirmasi(Request $request, $id)
    {
        $id = decrypt($id);
        $surat = LetterTanah::with('letter')->find($id);
        $surat->keterangan = $request->keterangan;
        if ($surat->keterangan == 'Data Lengkap') {
            $surat->letter()->update(['status' => 'menunggu tanda tangan']);
        } elseif ($surat->keterangan == 'Data Belum Lengkap') {
            $surat->letter()->update(['status' => 'sudah dikonfirmasi']);
        } else {
            $surat->letter()->update(['status' => 'selesai']);
        }
        $surat->save();

        // Ambil nomor WA user pengaju
        $user = User::find($surat->letter->user_id); // Sesuaikan dengan relasi user
        $userPhone = $user->phone; // Pastikan di database format nomor WA benar

        // Buat pesan notifikasi
        $message = "Halo *{$user->name}*, pengajuan surat pernyataan penguasaan tanah Anda sekarang berstatus: *{$surat->letter->status}*. Silakan cek aplikasi untuk informasi lebih lanjut.";

        // Dispatch Job untuk mengirim WhatsApp
        SendWhatsAppNotification::dispatch($userPhone, $message);


        Alert::success('Success', 'Pengajuan Berhasil Dikonfirmasi');
        return redirect()->route('surat-pernyataan-penguasaan-tanah.index');
    }

    public function suratTanahSelesai()
    {
        $surats = LetterTanah::with('letter')->whereHas('letter', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        return view('pages.admin.surat-selesai.SPPFBT.index', compact('surats'));
    }

    public function cetak($id)
    {
        $surat =  LetterTanah::with('letter')->find($id);
        // Initialize Dompdf
        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('letters.SPPFBT', compact('surat'))->render();
        // Load HTML content into the PDF
        $pdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render PDF (first pass)
        $pdf->render();

        // Stream the generated PDF to the browser for printing
        return $pdf->stream('sample.pdf', array("Attachment" => 0));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterTanah $letterTanah, $id)
    {

        $surat = LetterTanah::with('letter')->find(decrypt($id));
        return view('pages.masyarakat.SPPFBT.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterTanah $letterTanah, $id)
    {
        $validated = $this->validateRequest($request);
        $surat = LetterTanah::with('letter')->find(decrypt($id));

        try {
            DB::transaction(function () use ($request, $validated, $surat) {
                $surat->update($validated);

                $meta = collect($surat->letter->berkas);

                foreach (['scan_ktp', 'scan_kk', 'scan_SPPT_PBB', 'scan_surat_bukti'] as $field) {
                    if ($request->hasFile($field)) {

                        // hapus file lama
                        if ($old = $meta->firstWhere('name', $field)) {
                            Storage::disk('public')->delete($old['path']);
                            $meta = $meta->reject(fn($f) => $f['name'] === $field);
                        }

                        // simpan file baru
                        $file       = $request->file($field);
                        $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                        $storedPath = $file->storeAs('letters/kepemilikan_tanah', $filename, 'public');

                        $meta->push(['name' => $field, 'path' => $storedPath]);
                    }
                }
                // simpan metadata baru
                $surat->letter->update(['berkas' => $meta->values()]);
            });
            Alert::success('Success', 'Pengajuan Berhasil Diubah');
            return redirect()->route('surat-pernyataan-penguasaan-tanah.index');
        } catch (Exception $e) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surat = LetterTanah::with('letter')->findOrFail($id);

        DB::transaction(function() use($surat){
            if ($surat->letter && is_array($surat->letter->berkas)) {
                foreach ($surat->letter->berkas as $file) {
                    Storage::disk('public')->delete($file['path']);
                }
            }
    
            // Hapus relasi dulu
            $surat->letter()->delete();
    
            // Hapus surat tanah
            $surat->delete();
        });

        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->back()->with('Success', 'Pengajuan Berhasil dihapus!');
    }






    // ================== Helper ================================
    private function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_pemohon'      => 'required',
            'umur'              => 'required',
            'agama'              => 'required',
            'pekerjaan'         => 'required',
            'jenis_kelamin'     => 'required',
            'alamat'            => 'required',
            'lokasi_tanah'      => 'required',
            'luas_tanah'        => 'required',
            'harga_tanah'       => 'required',
            'status_tanah'      => 'required',
            'digunakan_tanah'   => 'required',
            'batas_barat'       => 'required',
            'batas_timur'       => 'required',
            'batas_utara'       => 'required',
            'batas_selatan'     => 'required',
        ];

        if ($includeFiles) {
            $fileRule = 'nullable|mimes:jpg,jpeg,png,pdf';
            $rules += [
                'scan_ktp'                 => $fileRule,
                'scan_kk'                  => $fileRule,
                'scan_SPPT_PBB'            => $fileRule,
                'scan_surat_bukti'         => $fileRule,
            ];
        }

        return $request->validate($rules);
    }

    /**
     * Simpan seluruh lampiran ke storage & kembalikan metadata.
     *
     * @throws FileNotFoundException
     */
    private function storeFiles(Request $request): array
    {
        return collect(['scan_ktp', 'scan_kk', 'scan_SPPT_PBB', 'scan_surat_bukti'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs('letters/kepemilikan_tanah', $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
