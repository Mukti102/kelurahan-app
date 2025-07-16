<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterPenghasilan;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LetterPenghasilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
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
        $user = auth()->user();
        // Validasi input
        $validated = $request->validate([
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
        ]);

        try {

            $letterPenghasilan =  LetterPenghasilan::create([
                ...$validated
            ]);

            $letter = new Letter([
                'user_id' => $user->id,
            ]);

            $letterPenghasilan->letter()->save($letter);

            Alert::success('Success', 'Pengajuan Berhasil Dikirim');
            // Redirect dengan pesan sukses
            return redirect()->route('surat-penghasilan.index')
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(LetterPenghasilan $letterPenghasilan, $id)
    {
        $auth = auth()->user();
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
        $validated = $request->validate([
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
        ]);

        $surat = LetterPenghasilan::with('letter')->find(decrypt($id));
        $surat->update($validated);
        Alert::success('Success', 'Pengajuan Berhasil Diubah');
        return redirect()->route('surat-keterangan-penghasilan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterPenghasilan $letterPenghasilan, $id)
    {
        $surat = LetterPenghasilan::with('letter')->find($id);
        $surat->letter()->delete();
        $surat->delete();
        Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        return redirect()->route('surat-keterangan-penghasilan.index');
    }
}
