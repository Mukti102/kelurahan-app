<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterPenghasilan;
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

class LetterPenghasilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $surats = LetterPenghasilan::with('letter')
            ->whereHas('letter', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        if ($user->role == 'admin') {
            $surats = LetterPenghasilan::with('letter')->whereHas('letter', function ($query) {
                $query->where('status', '!=', 'selesai');
            })->get();
            return view('pages.admin.surat-masuk.SKP.index', compact('surats'));
        } elseif ($user->role == 'lurah') {
            $surats = LetterPenghasilan::with('letter')
                ->whereHas('letter', function ($query) {
                    $query->where('status', 'menunggu tanda tangan');
                })
                ->get();
            return view('pages.lurah.SKP.index', compact('surats'));
        } else {
            return view('pages.masyarakat.SKP.index', compact('surats'));
        }
    }

    public function suratPenghasilanSelesai()
    {
        $surats = LetterPenghasilan::with('letter')->whereHas('letter', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        return view('pages.admin.surat-selesai.SKP.index', compact('surats'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.masyarakat.SKP.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // Validasi input
        $validated = $this->validateRequest($request);

        try {

            DB::transaction(function () use ($validated, $request, $user) {

                $letterPenghasilan =  LetterPenghasilan::create($validated);

                $filesMeta = $this->storeFiles($request);

                $letter = new Letter([
                    'user_id' => $user->id,
                    'priority' => 0,
                    'status' => 'sedang diproses',
                    'berkas' => $filesMeta,
                ]);

                $letterPenghasilan->letter()->save($letter);
            });

            Alert::success('Success', 'Pengajuan Berhasil Dikirim');
            // Redirect dengan pesan sukses
            return redirect()->route('surat-keterangan-penghasilan.index')
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            Log::info('error store penghasilan',['message' => $e->getMessage()]);
            Alert::error("error", "Gagal Mengirim Surat");
            // Redirect dengan pesan error
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(LetterPenghasilan $letterPenghasilan, $id)
    {
        $auth = Auth::user();
        $id = decrypt($id);
        $surat = LetterPenghasilan::find($id);
        if ($auth->role == 'lurah') {
            return view('pages.lurah.SKP.show', compact('surat'));
        } elseif ($auth->role == 'admin') {
            return view('pages.admin.surat-masuk.SKP.show', compact('surat'));
        }
    }

    public function cetak($id)
    {
        $surat =  LetterPenghasilan::with('letter')->find($id);
        // Initialize Dompdf
        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('letters.SKP', compact('surat'))->render();
        // Load HTML content into the PDF
        $pdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render PDF (first pass)
        $pdf->render();

        // Stream the generated PDF to the browser for printing
        return $pdf->stream('sample.pdf', array("Attachment" => 0));
    }

    public function konfirmasi(Request $request, $id)
    {
        $id = decrypt($id);
        $surat = LetterPenghasilan::find($id);
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
        $message = "Halo *{$user->name}*, pengajuan surat penghasilan Anda sekarang berstatus: *{$surat->letter->status}*. Silakan cek aplikasi untuk informasi lebih lanjut.";

        // Dispatch Job untuk mengirim WhatsApp
        SendWhatsAppNotification::dispatch($userPhone, $message);

        Alert::success('Success', 'Pengajuan Berhasil Dikonfirmasi');
        return redirect()->route('surat-keterangan-penghasilan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterPenghasilan $letterPenghasilan, $id)
    {
        $surat = LetterPenghasilan::with('letter')->find(decrypt($id));
        return view('pages.masyarakat.SKP.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterPenghasilan $letterPenghasilan, $id)
    {
        $validated = $this->validateRequest($request);
        $surat = LetterPenghasilan::with('letter')->find(decrypt($id));
        try {
            DB::transaction(function () use ($validated, $request, $surat) {
                $surat->update($validated);

                $meta = collect($surat->letter->berkas);

                foreach (['scan_ktp', 'scan_kk'] as $field) {
                    if ($request->hasFile($field)) {

                        // hapus file lama
                        if ($old = $meta->firstWhere('name', $field)) {
                            Storage::disk('public')->delete($old['path']);
                            $meta = $meta->reject(fn($f) => $f['name'] === $field);
                        }

                        // simpan file baru
                        $file       = $request->file($field);
                        $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                        $storedPath = $file->storeAs('letters/penghasilan_ortu', $filename, 'public');

                        $meta->push(['name' => $field, 'path' => $storedPath]);
                    }
                }
                // simpan metadata baru
                $surat->letter->update(['berkas' => $meta->values()]);
            });
            Alert::success('Success', 'Pengajuan Berhasil Diubah');
            return redirect()->route('surat-keterangan-penghasilan.index');
        } catch (Exception $e) {
            Alert::error("Error", "Gagal Mengupdate");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterPenghasilan $letterPenghasilan, $id)
    {
        $surat = LetterPenghasilan::with('letter')->find($id);

        if ($surat->letter && is_array($surat->letter->berkas)) {
            foreach ($surat->letter->berkas as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $surat->letter()->delete();
        $surat->delete();
        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('surat-keterangan-penghasilan.index');
    }


    // ================== Helper ================================
    private function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'penghasilan' => 'required|string|max:255',
            'keperluan' => 'required',
            'nama_anak' => 'required|string|max:255',
            'nik_anak' => 'required|string|max:255',
            'pekerjaan_anak' => 'required|string|max:255',
            'jenis_kelamin_anak' => 'required|in:laki-laki,perempuan',
            'tempat_lahir_anak' => 'required',
            'tanggal_lahir_anak' => 'required',
            'agama_anak' => 'required',
            'alamat_anak' => 'required',
        ];

        if ($includeFiles) {
            $fileRule = 'nullable|mimes:jpg,jpeg,png,pdf';
            $rules += [
                'scan_ktp'                 => $fileRule,
                'scan_kk'                  => $fileRule,
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
        return collect(['scan_ktp', 'scan_kk'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs('letters/penghasilan_ortu', $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
