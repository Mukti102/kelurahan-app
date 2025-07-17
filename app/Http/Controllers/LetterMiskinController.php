<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterMiskin;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LetterMiskinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = FacadesAuth::user();
        $surats = LetterMiskin::with('letter')
            ->whereHas('letter', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        if ($user->role == 'admin') {
            $surats = LetterMiskin::with('letter')->whereHas('letter', function ($query) {
                $query->where('status', '!=', 'selesai');
            })->get();
            return view('pages.admin.surat-masuk.SKM.index', compact('surats'));
        } elseif ($user->role == 'lurah') {
            $surats = LetterMiskin::with('letter')
                ->whereHas('letter', function ($query) {
                    $query->where('status', 'menunggu tanda tangan');
                })
                ->get();
            return view('pages.lurah.SKM.index', compact('surats'));
        } else {
            return view('pages.masyarakat.SKM.index', compact('surats'));
        }
    }

    public function suratMiskinSelesai()
    {
        $surats = LetterMiskin::with('letter')->whereHas('letter', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        return view('pages.admin.surat-selesai.SKM.index', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.masyarakat.SKM.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = FacadesAuth::user();

        $validatedData = $this->validateRequest($request);

        try {
            DB::transaction(function () use ($user, $request, $validatedData) {

                $letterMiskin = LetterMiskin::create($validatedData);

                $filesMeta = $this->storeFiles($request);

                $letter = new Letter([
                    'user_id' => $user->id,
                    'priority' => 1,
                    'status' => 'sedang diproses',
                    'berkas' => $filesMeta
                ]);

                $letterMiskin->letter()->save($letter);
            });

            // alert
            Alert::success('Success', 'Pengajuan Berhasil Dikirim');


            // Redirect dengan pesan sukses
            return redirect()->route('surat-keterangan-miskin.index')->with('success', 'Pengajuan berhasil disimpan.');
        } catch (Exception $e) {
        }
    }

    public function cetak($id)
    {
        $surat =  LetterMiskin::with('letter')->find($id);
        // Initialize Dompdf
        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('letters.SKM', compact('surat'))->render();
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
    public function show(LetterMiskin $letterMiskin, $id)
    {
        $auth = FacadesAuth::user();
        $surat = LetterMiskin::find(decrypt($id));
        if ($auth->role == 'admin') {
            return view('pages.admin.surat-masuk.SKM.show', compact('surat'));
        } elseif ($auth->role == 'lurah') {
            return view('pages.lurah.SKM.show', compact('surat'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterMiskin $letterMiskin, $id)
    {
        $surat = LetterMiskin::with('letter')->find(decrypt($id));
        return view('pages.masyarakat.SKM.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LetterMiskin $letterMiskin, $id)
    {
        $validatedData = $this->validateRequest($request);

        try {
            DB::transaction(function () use ($request, $id, $validatedData) {
                $surat = LetterMiskin::find(decrypt($id));

                $surat->update($validatedData);

                $meta = collect($surat->letter->berkas);

                foreach (['scan_ktp', 'scan_kk', 'scan_surat_keterangan'] as $field) {
                    if ($request->hasFile($field)) {

                        // hapus file lama
                        if ($old = $meta->firstWhere('name', $field)) {
                            Storage::disk('public')->delete($old['path']);
                            $meta = $meta->reject(fn($f) => $f['name'] === $field);
                        }

                        // simpan file baru
                        $file       = $request->file($field);
                        $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                        $storedPath = $file->storeAs('letters/miskin', $filename, 'public');

                        $meta->push(['name' => $field, 'path' => $storedPath]);
                    }
                }
                // simpan metadata baru
                $surat->letter->update(['berkas' => $meta->values()]);
            });
            Alert::success('Success', 'Pengajuan Berhasil Diupdate');
            return redirect()->route('surat-keterangan-miskin.index');
        } catch (Exception $e) {
            Alert::error("Error", "Gagal Memperbarui");
            return back();
        }
    }


    public function konfirmasi(Request $request, $id)
    {
        $id = decrypt($id);
        $surat = LetterMiskin::with('letter')->find($id);
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
        $message = "Halo *{$user->name}*, pengajuan surat keterangan tidak mampu Anda sekarang berstatus: *{$surat->letter->status}*. Silakan cek aplikasi untuk informasi lebih lanjut.";

        // Dispatch Job untuk mengirim WhatsApp
        SendWhatsAppNotification::dispatch($userPhone, $message);


        Alert::success('Success', 'Pengajuan Berhasil Dikonfirmasi');
        return redirect()->route('surat-keterangan-miskin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterMiskin $letterMiskin, $id)
    {
        $surat = LetterMiskin::with('letter')->find($id);
        // Hapus semua file dari storage
        if ($surat->letter && is_array($surat->letter->berkas)) {
            foreach ($surat->letter->berkas as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $surat->letter()->delete();
        $surat->delete();
        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('surat-keterangan-miskin.index');
    }

    private function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|max:16|min:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|string|max:255',
            'kewarganegaraan' => 'required',
            'status_perkawinan' => 'required|in:kawin,belum kawin',
            'pekerjaan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'penghasilan' => 'required|string|max:255',
            'alamat' => 'required',
            'jumlah_anggota_keluarga' => 'required|numeric|min:1',
        ];

        $costumMessage = [
            'nik_pemohon.min' => 'NIK harus 16 digit',
            'nik_pemohon.max' => 'NIK harus 16 digit',
            'nik_pemohon.min' => 'NIK harus 16 digit',
            'nik_pemohon.max' => 'NIK harus 16 digit',
            'jumlah_anggota_keluarga.min' => 'Jumlah anggota keluarga harus lebih dari 0',
            'jumlah_anggota_keluarga.max' => 'Jumlah anggota keluarga harus lebih dari 0',
        ];

        if ($includeFiles) {
            $fileRule = 'nullable|mimes:jpg,jpeg,png,pdf';
            $rules += [
                'scan_ktp'                 => $fileRule,
                'scan_kk'                  => $fileRule,
                'scan_surat_keterangan' => $fileRule,
            ];
        }

        return $request->validate($rules, $costumMessage);
    }

    /**
     * Simpan seluruh lampiran ke storage & kembalikan metadata.
     *
     * @throws FileNotFoundException
     */
    private function storeFiles(Request $request): array
    {
        return collect(['scan_ktp', 'scan_kk', 'scan_surat_keterangan'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs('letters/miskin', $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
