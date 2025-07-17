<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppNotification;
use App\Models\Letter;
use App\Models\LetterMeninggal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class LetterMeninggalController extends Controller
{
    /* ---------------------------------------------------------------------
     |  Konstanta status & path upload                                     |
     |---------------------------------------------------------------------*/
    public const STORAGE_PATH = 'letters/surat_meninggal';
    public const STATUS_PROSES    = 'sedang diproses';
    public const STATUS_TTD       = 'menunggu tanda tangan';
    public const STATUS_KONFIRM   = 'sudah dikonfirmasi';
    public const STATUS_SELESAI   = 'selesai';

    /* ---------------------------------------------------------------------
     |  INDEX                                                              |
     |---------------------------------------------------------------------*/
    public function index()
    {
        $user  = Auth::user();

        $surats = LetterMeninggal::with('letter')
            ->when($user->role === 'admin', fn($q) => $q->whereHas('letter', fn($qq) => $qq->where('status', '!=', self::STATUS_SELESAI)))
            ->when($user->role === 'lurah', fn($q) => $q->whereHas('letter', fn($qq) => $qq->where('status', self::STATUS_TTD)))
            ->when($user->role === 'user',  fn($q) => $q->whereHas('letter', fn($qq) => $qq->where('user_id', $user->id)))
            ->get();

        return match ($user->role) {
            'admin'  => view('pages.admin.surat-masuk.SKMD.index', compact('surats')),
            'lurah'  => view('pages.lurah.SKMD.index', compact('surats')),
            default  => view('pages.masyarakat.SKMD.index', compact('surats')),
        };
    }

    /* ---------------------------------------------------------------------
     |  FORM & LIST TAMBAHAN                                               |
     |---------------------------------------------------------------------*/
    public function create()
    {
        return view('pages.masyarakat.SKMD.create');
    }

    public function suratMeninggalSelesai()
    {
        $surats = LetterMeninggal::with('letter')
            ->whereHas('letter', fn($q) => $q->where('status', self::STATUS_SELESAI))
            ->get();

        return view('pages.admin.surat-selesai.SKMD.index', compact('surats'));
    }

    public function cetak(int $id)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail($id);

        $pdf = Pdf::loadView('letters.SKMD', compact('surat'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat_meninggal_' . now()->timestamp . '.pdf', ["Attachment" => false]);
    }

    /* ---------------------------------------------------------------------
     |  STORE                                                              |
     |---------------------------------------------------------------------*/
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        try {
            DB::transaction(function () use ($validated, $request) {
                /** @var \App\Models\LetterMeninggal $letterMeninggal */
                $letterMeninggal = LetterMeninggal::create($validated);

                $filesMeta = $this->storeFiles($request);

                $letter = new Letter([
                    'user_id'  => Auth::user()->id,
                    'priority' => 3,
                    'status'   => self::STATUS_PROSES,
                    'berkas'   => $filesMeta,
                ]);

                $letterMeninggal->letter()->save($letter);
            });

            Alert::success('Success', 'Pengajuan berhasil dikirim');
            return redirect()->route('surat-keterangan-meninggal-dunia.index');
        } catch (QueryException | FileNotFoundException | Throwable $e) {
            Log::error('Gagal menyimpan SKMD', ['msg' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /* ---------------------------------------------------------------------
     |  SHOW / EDIT / UPDATE                                               |
     |---------------------------------------------------------------------*/
    public function show(string $encryptedId)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail(decrypt($encryptedId));
        $view  = Auth::user()->role === 'admin' ? 'pages.admin.surat-masuk.SKMD.show' : 'pages.lurah.SKMD.show';
        return view($view, compact('surat'));
    }

    public function edit(string $encryptedId)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail(decrypt($encryptedId));
        return view('pages.masyarakat.SKMD.edit', compact('surat'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail(decrypt($encryptedId));

        // Validasi (hanya tambahkan rule file bila memang ada file yang dikirim)
        $validated = $this->validateRequest(
            $request,
            $request->hasAny(['scan_ktp', 'scan_kk', 'scan_surat_keterangan_rm', 'scan_ktp_pelapor'])
        );

        DB::transaction(function () use ($request, $surat, $validated) {

            // Update data teks surat
            $surat->update($validated);

            $meta = collect($surat->letter->berkas);   // meta lama

            foreach (['scan_ktp', 'scan_kk', 'scan_surat_keterangan_rm', 'scan_ktp_pelapor'] as $field) {
                if ($request->hasFile($field)) {

                    // hapus file lama
                    if ($old = $meta->firstWhere('name', $field)) {
                        Storage::disk('public')->delete($old['path']);
                        $meta = $meta->reject(fn($f) => $f['name'] === $field);
                    }

                    // simpan file baru
                    $file       = $request->file($field);
                    $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                    $storedPath = $file->storeAs(self::STORAGE_PATH, $filename, 'public');

                    $meta->push(['name' => $field, 'path' => $storedPath]);
                }
            }


            // simpan metadata baru
            $surat->letter->update(['berkas' => $meta->values()]);
        });

        Alert::success('Success', 'Pengajuan berhasil di‑update');
        return redirect()->route('surat-keterangan-meninggal-dunia.index');
    }


    /* ---------------------------------------------------------------------
     |  KONFIRMASI                                                         |
     |---------------------------------------------------------------------*/
    public function konfirmasi(Request $request, string $encryptedId)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail(decrypt($encryptedId));

        $surat->keterangan = $request->keterangan;
        $status           = match ($request->keterangan) {
            'Data Lengkap'       => self::STATUS_TTD,
            'Data Belum Lengkap' => self::STATUS_KONFIRM,
            default              => self::STATUS_SELESAI,
        };

        $surat->letter()->update(['status' => $status]);
        $surat->save();

        // Kirim notifikasi WA (asynchronous)
        $user = User::find($surat->letter->user_id);
        SendWhatsAppNotification::dispatchAfterResponse($user->phone, "Halo *{$user->name}*, pengajuan surat meninggal dunia Anda sekarang berstatus: *{$status}*. Silakan cek aplikasi untuk info lebih lanjut.");

        Alert::success('Success', 'Pengajuan berhasil dikonfirmasi');
        return redirect()->route('surat-keterangan-meninggal-dunia.index');
    }

    /* ---------------------------------------------------------------------
     |  DELETE                                                             |
     |---------------------------------------------------------------------*/
    public function destroy(int $id)
    {
        $surat = LetterMeninggal::with('letter')->findOrFail($id);

        // Hapus semua file dari storage
        if ($surat->letter && is_array($surat->letter->berkas)) {
            foreach ($surat->letter->berkas as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $surat->letter()->delete();
        $surat->delete();

        Alert::success('Success', 'Pengajuan berhasil dihapus');
        return redirect()->route('surat-keterangan-meninggal-dunia.index');
    }

    /* ---------------------------------------------------------------------
     |  PRIVATE HELPER                                                     |
     |---------------------------------------------------------------------*/
    /**
     * Rule validasi untuk store & update.
     *
     * @param Request $request
     * @param bool    $includeFiles  Apakah perlu mem‑validasi lampiran? (true = store)
     * @return array<string, mixed>
     */
    private function validateRequest(Request $request, bool $includeFiles = true): array
    {
        $rules = [
            'nama_almarhum'        => 'required|string|max:255',
            'tempat_lahir'         => 'required|string|max:255',
            'tanggal_lahir'        => 'required|date',
            'jenis_kelamin'        => 'required|in:laki-laki,perempuan',
            'agama'                => 'required|string|max:255',
            'kewarganegaraan'      => 'required|string|max:255',
            'tanggal_meninggal'    => 'required',
            'tempat_kematian'      => 'required|string|max:255',
            'penyebab_meninggal'   => 'required|string|max:255',
            'tanggal_pembumikan'   => 'required',
            'tempat_pemakaman'     => 'required|string|max:255',
            'alamat'               => 'required|string|max:255',
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
        return collect(['scan_ktp', 'scan_kk', 'scan_surat_keterangan_rm', 'scan_ktp_pelapor'])
            ->filter(fn($field) => $request->hasFile($field))
            ->map(function ($field) use ($request) {
                $file       = $request->file($field);
                $filename   = $field . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $storedPath = $file->storeAs(self::STORAGE_PATH, $filename, 'public');

                return [
                    'name' => $field,
                    'path' => $storedPath,
                ];
            })
            ->values()
            ->all();
    }
}
