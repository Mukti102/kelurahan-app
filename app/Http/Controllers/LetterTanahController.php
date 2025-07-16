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
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LetterTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
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
        // return $request->all();
        // Validasi input data
        $request->validate([
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
        ]);

        try {

            $user = auth()->user();


            // Simpan data tanah ke database
            $letterTanah = LetterTanah::create([
                'nama_pemohon'      => $request->nama_pemohon,
                'umur'              => $request->umur,
                'agama'              => $request->agama,
                'pekerjaan'         => $request->pekerjaan,
                'alamat'         => $request->alamat,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'lokasi_tanah'      => $request->lokasi_tanah,
                'luas_tanah'        => $request->luas_tanah,
                'harga_tanah'       => $request->harga_tanah,
                'status_tanah'      => $request->status_tanah,
                'digunakan_tanah'   => $request->digunakan_tanah,
                'batas_barat'       => $request->batas_barat,
                'batas_timur'       => $request->batas_timur,
                'batas_utara'       => $request->batas_utara,
                'batas_selatan'     => $request->batas_selatan,
            ]);

            $letter = new Letter([
                'user_id'   => $user->id,
            ]);

            $letterTanah->letter()->save($letter);

            Alert::success('Success', 'Data berhasil di kirim');

            // Mengalihkan user ke halaman yang diinginkan setelah berhasil menyimpan data
            return redirect()->route('surat-pernyataan-penguasaan-tanah.index')->with('success', 'Data berhasil disimpan');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Error', $e->getMessage());
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterTanah $letterTanah, $id)
    {
        $auth = auth()->user();
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
        $request->validate([
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
        ]);

        $surat = LetterTanah::with('letter')->find(decrypt($id));
        $surat->update($request->all());
        Alert::success('Success', 'Pengajuan Berhasil Diubah');
        return redirect()->route('surat-pernyataan-penguasaan-tanah.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surat = LetterTanah::with('letter')->findOrFail($id);
        
        // Hapus relasi dulu
        $surat->letter()->delete();
        
        // Hapus surat tanah
        $surat->delete();
    
        // Alert::success('Success', 'Pengajuan Berhasil Dihapus');
        // return redirect()->route('pages.admin.surat-masuk.SPPFBT.index');
        return redirect()->back()->with('Success', 'Pengajuan Berhasil dihapus!');

    }
    
}
