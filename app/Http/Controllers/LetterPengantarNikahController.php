<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterPengantarNikah;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LetterPengantarNikahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $surats = LetterPengantarNikah::with('letter')
            ->whereHas('letter', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        if ($user->role == 'admin') {
            $surats = LetterPengantarNikah::with('letter')->whereHas('letter', function ($query) {
                $query->where('status', '!=', 'selesai');
            })->get();
            return view('pages.admin.surat-masuk.SPN.index', compact('surats'));
        } elseif ($user->role == 'lurah') {
            $surats = LetterPengantarNikah::with('letter')
                ->whereHas('letter', function ($query) {
                    $query->where('status', 'menunggu tanda tangan');
                })
                ->get();
            return view('pages.lurah.SPN.index', compact('surats'));
        } else {
            return view('pages.masyarakat.SPN.index', compact('surats'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.masyarakat.SPN.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validasi data input
        $validatedData = $this->validateRequest($request);

        try {
            DB::transaction(function () use ($request, $validatedData) {
                // Simpan data ke database
                $letterPengantarNikah =  LetterPengantarNikah::create($validatedData);

                $fileMeta = $this->storeFiles($request);


                $letter = new Letter([
                    'user_id' => Auth::user()->id,
                    'priority' => 0,
                    'status' => 'sedang diproses',
                    'berkas' => $fileMeta,
                ]);

                $letterPengantarNikah->letter()->save($letter);
            });

            Alert::success('Success', 'Pengajuan Berhasil Dikirim');
            return redirect()->route('surat-pengantar-nikah.index')->with('success', 'berhasil Di kirim');
        } catch (Exception $e) {
            Log::info("error Create Surat Nikah", ['message' => $e->getMessage()]);
            Alert::error("error", "gagal Mengirim Surat Nikah");
            return back();
        }
    }

    public function cetak($id)
    {
        $surat =  LetterPengantarNikah::with('letter')->find($id);
        // Initialize Dompdf
        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('letters.SPN', compact('surat'))->render();
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
     * Display the specified resource.
     */
    public function show(LetterPengantarNikah $letterPengantarNikah, $id)
    {
        $surat = LetterPengantarNikah::find(decrypt($id));
        $auth = Auth::user();
        if ($auth->role == 'admin') {
            return view('pages.admin.surat-masuk.SPN.show', compact('surat'));
        } elseif ($auth->role == 'lurah') {
            return view('pages.lurah.SPN.show', compact('surat'));
        }
    }

    public function konfirmasi(Request $request, $id)
    {
        $id = decrypt($id);
        $surat = LetterPengantarNikah::with('letter')->find($id);
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
        $message = "Halo *{$user->name}*, pengajuan surat pemgantar nikah Anda sekarang berstatus: *{$surat->letter->status}*. Silakan cek aplikasi untuk informasi lebih lanjut.";

        // Dispatch Job untuk mengirim WhatsApp
        SendWhatsAppNotification::dispatch($userPhone, $message);



        Alert::success('Success', 'Pengajuan Berhasil Dikonfirmasi');
        return redirect()->route('surat-pengantar-nikah.index');
    }

    public function suratPengantarNikahSelesai()
    {
        $surats = LetterPengantarNikah::with('letter')->whereHas('letter', function ($query) {
            $query->where('status', 'selesai');
        })->get();

        return view('pages.admin.surat-selesai.SPN.index', compact('surats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterPengantarNikah $letterPengantarNikah, $id)
    {
        $surat = LetterPengantarNikah::with('letter')->find(decrypt($id));
        return view('pages.masyarakat.SPN.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterPengantarNikah $letterPengantarNikah, $id)
    {
        $validatedData = $this->validateRequest($request);
        $surat = LetterPengantarNikah::with('letter')->find(decrypt($id));
        try {
            DB::transaction(function () use ($request, $validatedData, $surat) {
                $surat->update($validatedData);

                $meta = collect($surat->letter->berkas);   // meta lama

                foreach (['scan_ktp_calon_mempelai', 'scan_kk_calon_mempelai', 'scan_akta_kelahiran'] as $field) {
                    if ($request->hasFile($field)) {
                        // hapus file lama
                        if ($old = $meta->firstWhere('name', $field)) {
                            Storage::disk('public')->delete($old['path']);
                            $meta = $meta->reject(fn($f) => $f['name'] === $field);
                        }

                        // simpan file baru
                        $file       = $request->file($field);
                        $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                        $storedPath = $file->storeAs('letters/surat_nikah', $filename, 'public');

                        $meta->push(['name' => $field, 'path' => $storedPath]);
                    }
                }

                $surat->letter->update(['berkas' => $meta->values()]);
            });
            Alert::success('Success', 'Pengajuan Berhasil Diubah');
            return redirect()->route('surat-pengantar-nikah.index');
        } catch (Exception $e) {
            Log::info('Infor Eror Update Surat Nikah', ['message' => $e->getMessage()]);
            Alert::error("error", 'Gagal Update Surat Nikah');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterPengantarNikah $letterPengantarNikah, $id)
    {
        $surat = LetterPengantarNikah::with('letter')->find($id);

        if ($surat->letter && is_array($surat->letter->berkas)) {
            foreach ($surat->letter->berkas as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $surat->letter()->delete();
        $surat->delete();
        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('surat-pengantar-nikah.index');
    }





    // ====================== Helper =================================
    private function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_lengkap_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required',
            'tempat_lahir_ayah' => 'required|string|max:255',
            'tanggal_lahir_ayah' => 'required|date',
            'kewarganegaraan_ayah' => 'required|string|max:50',
            'agama_ayah' => 'required|string|max:50',
            'pekerjaan_ayah' => 'required|string|max:255',
            'alamat_ayah' => 'required|string|max:255',
            'nama_lengkap_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required',
            'tempat_lahir_ibu' => 'required|string|max:255',
            'tanggal_lahir_ibu' => 'required|date',
            'kewarganegaraan_ibu' => 'required|string|max:50',
            'pekerjaan_ibu' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:255',
        ];

        if ($includeFiles) {
            $fileRule = 'nullable|mimes:jpg,jpeg,png,pdf';
            $rules += [
                'scan_ktp'                 => $fileRule,
                'scan_kk'                  => $fileRule,
                'scan_surat_keterangan_rm' => $fileRule,
                'scan_ktp_pelapor'         => $fileRule,
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
        return collect(['scan_ktp_calon_mempelai', 'scan_kk_calon_mempelai', 'scan_akta_kelahiran'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs('letters/surat_nikah', $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
