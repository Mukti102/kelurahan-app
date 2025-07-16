<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterSKCK;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LetterSKCKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $surats = LetterSKCK::with('letter')
            ->whereHas('letter', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        if ($user->role == 'admin') {
            $surats = LetterSKCK::with('letter')->whereHas('letter', function ($query) {
                $query->where('status', '!=', 'selesai');
            })->get();
            return view('pages.admin.surat-masuk.SPS.index', compact('surats'));
        } elseif ($user->role == 'lurah') {
            $surats = LetterSKCK::with('letter')
                ->whereHas('letter', function ($query) {
                    $query->where('status', 'menunggu tanda tangan');
                })
                ->get();
            return view('pages.lurah.SPS.index', compact('surats'));
        } else {
            return view('pages.masyarakat.SPS.index', compact('surats'));
        }
    }

    public function suratSKCKSelesai()
    {

        $surats = LetterSKCK::with('letter')->whereHas('letter', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        return view('pages.admin.surat-selesai.SPS.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.masyarakat.SPS.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $auth = Auth::user();
        // Validasi input dari form
        $validated = $this->validateRequest($request, $request->hasAny('scan_ktp', 'scan_kk'));

        try {
            DB::transaction(function () use ($request, $validated, $auth) {
                // Simpan data ke database
                $letterSKCK = LetterSKCK::create($validated);

                $filesMeta = $this->storeFiles($request);

                $letter = new Letter([
                    'user_id' => $auth->id,
                    'priority' => 9,
                    'berkas' => $filesMeta
                ]);

                $letterSKCK->letter()->save($letter);
            });

            // alert
            Alert::success('Success', 'Pengajuan Berhasil Dikirim');
            // Redirect ke halaman tertentu dengan pesan sukses
            return redirect()->route('surat-pengantar-skck.index')
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Redirect ke halaman sebelumnya dengan pesan error
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(LetterSKCK $letterSKCK, $id)
    {
        $auth = Auth::user();
        $surat = LetterSKCK::find(decrypt($id));
        if ($auth->role == 'admin') {
            return view('pages.admin.surat-masuk.SPS.show', compact('surat'));
        } elseif ($auth->role == 'lurah') {
            return view('pages.lurah.SPS.show', compact('surat'));
        }
    }

    public function cetak($id)
    {
        $surat =  LetterSKCK::with('letter')->find($id);
        // Initialize Dompdf
        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('letters.SPS', compact('surat'))->render();
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
    public function edit(LetterSKCK $letterSKCK, $id)
    {
        $surat = LetterSKCK::with('letter')->find(decrypt($id));
        return view('pages.masyarakat.SPS.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterSKCK $letterSKCK, $id)
    {
        $validated = $this->validateRequest($request, $request->hasAny('scan_ktp', 'scan_kk'));
        $surat = LetterSKCK::with('letter')->find(decrypt($id));

        try {

            DB::transaction(function () use ($request, $surat, $validated) {
                // update 
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
                        $storedPath = $file->storeAs('letters/skck', $filename, 'public');

                        $meta->push(['name' => $field, 'path' => $storedPath]);
                    }
                }


                // simpan metadata baru
                $surat->letter->update(['berkas' => $meta->values()]);
            });
            Alert::success('Success', 'Pengajuan Berhasil Diubah');
            return redirect()->route('surat-pengantar-skck.index');
        } catch (Exception $e) {
            Alert::error('Error',"Gagal Di Update");
            return back();
        }

    }

    public function konfirmasi(Request $request, $id)
    {
        $id = decrypt($id);
        $surat = LetterSKCK::with('letter')->find($id);
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
        $message = "Halo *{$user->name}*, pengajuan surat pengantar skck Anda sekarang berstatus: *{$surat->letter->status}*. Silakan cek aplikasi untuk informasi lebih lanjut.";

        // Dispatch Job untuk mengirim WhatsApp
        SendWhatsAppNotification::dispatch($userPhone, $message);

        Alert::success('Success', 'Pengajuan Berhasil Dikonfirmasi');
        return redirect()->route('surat-pengantar-skck.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterSKCK $letterSKCK, $id)
    {
        $surat = LetterSKCK::with('letter')->find($id);
        $surat->letter()->delete();
        $surat->delete();
        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('surat-pengantar-skck.index');
    }


    // helper

    public function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'kewarganegaraan' => 'required',
            'agama' => 'required|string|max:50',
            'alamat' => 'required',
            'status_perkawinan' => 'required|in:kawin,belum kawin',
            'pekerjaan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
        ];

        if ($includeFiles) {
            $fileRule = 'required|mimes:jpg,png,jpeg,pdf';
            $rules += [
                'scan_ktp' => $fileRule,
                'scan_kk' => $fileRule,
            ];
        }

        return $request->validate($rules);
    }

    private function storeFiles(Request $request): array
    {
        return collect(['scan_ktp', 'scan_kk'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs('letters/skck', $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
