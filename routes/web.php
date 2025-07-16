<?php

use App\Http\Controllers\AlgorytmanDpsFifoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LetterMeninggalController;
use App\Http\Controllers\LetterMiskinController;
use App\Http\Controllers\LetterPengantarNikahController;
use App\Http\Controllers\LetterPenghasilanController;
use App\Http\Controllers\LetterSKCKController;
use App\Http\Controllers\LetterTanahController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengaturansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuccessListController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminLurahMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LurahMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Models\LetterMeninggal;
use App\Models\LetterMiskin;
use App\Models\LetterPenghasilan;
use App\Models\News;
use App\Models\Pengaturans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $berita = News::latest()->take(3)->get();
    return view('pages.main', compact('berita'));
});

Route::get('/index', function () {
    return view('index');
});

Route::resource('/berita', NewsController::class)->only('index', 'show',);
Route::resource('/testimoni', TestimoniController::class)->only('index');



Route::middleware(['auth', 'verified'])->group(function () {

    // dps fifo
    Route::resource('/surat-masuk', AlgorytmanDpsFifoController::class);


    // surat kematian
    Route::resource('/surat-keterangan-meninggal-dunia', LetterMeninggalController::class)->parameters(['surat-keterangan-meninggal-dunia' => 'skmd']);


    // surat miskin
    Route::resource('/surat-keterangan-miskin', LetterMiskinController::class)->parameters(['surat-keterangan-miskin' => 'skm']);


    // surat skck
    Route::resource('/surat-pengantar-skck', LetterSKCKController::class)->parameters(['surat-pengantar-skck' => 'skck']);


    // surat penghasilan
    Route::resource('/surat-keterangan-penghasilan', LetterPenghasilanController::class)->parameters(['surat-keterangan-penghasilan' => 'skp']);


    // surat pengantar nikah
    Route::resource('/surat-pengantar-nikah', LetterPengantarNikahController::class)->parameters(['surat-pengantar-nikah' => 'spn']);


    // surat pengajuan tanah
    Route::resource('/surat-pernyataan-penguasaan-tanah', LetterTanahController::class)->parameters(['surat-pernyataan-penguasaan-tanah' => 'sppfbt']);


    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// admin dan lurah
Route::middleware(['auth', 'verified', AdminLurahMiddleware::class])->group(function () {

    // penduduk 
    Route::resource('/penduduk', PendudukController::class)->parameters(['penduduk' => 'penduduk']);


    // pengajuan tanah
    Route::post('/surat-pernyataan-penguasaan-tanah/{id}/konfirmasi', [LetterTanahController::class, 'konfirmasi'])->name('surat-pernyataan-penguasaan-tanah.konfirmasi');
    Route::get('/surat-tanah/{id}/pdf', [LetterTanahController::class, 'cetak'])->name('surat-tanah.pdf');
    Route::delete('/surat-tanah/{id}', [LetterTanahController::class, 'destroy'])->name('surat-tanah.destroy');
    Route::get('/surat-tanah/selesai', [LetterTanahController::class, 'suratTanahSelesai'])->name('surat-pernyataan-penguasaan-tanah.selesai');

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');

    // surat pengantar nikah
    Route::post('/surat-pengantar-nikah/{id}/konfirmasi', [LetterPengantarNikahController::class, 'konfirmasi'])->name('surat-pengantar-nikah.konfirmasi');
    Route::get('/surat-nikah/selesai', [LetterPengantarNikahController::class, 'suratPengantarNikahSelesai'])->name('surat-pengantar-nikah.selesai');
    Route::get('/surat-nikah/{id}/pdf', [LetterPengantarNikahController::class, 'cetak'])->name('surat-nikah.pdf');

    // surat keterangan penghasilan
    Route::post('/surat-keterangan-penghasilan/{id}/konfirmasi', [LetterPenghasilanController::class, 'konfirmasi'])->name('surat-keterangan-penghasilan.konfirmasi');
    Route::get('/surat-penghasilan/selesai', [LetterPenghasilanController::class, 'suratPenghasilanSelesai'])->name('surat-penghasilan.selesai');
    Route::get('/surat-penghasilan/{id}/pdf', [LetterPenghasilanController::class, 'cetak'])->name('surat-penghasilan.pdf');


    // surat pengantar skck
    Route::post('/surat-pengantar-skck/{id}/konfirmasi', [LetterSKCKController::class, 'konfirmasi'])->name('surat-pengantar-skck.konfirmasi');
    Route::get('/surat-skck/selesai', [LetterSKCKController::class, 'suratSKCKSelesai'])->name('surat-pengantar-skck.selesai');
    Route::get('/surat-skck/{id}/pdf', [LetterSKCKController::class, 'cetak'])->name('surat-skck.pdf');


    // surat keterangan miskin
    Route::post('/surat-keterangan-miskin/{id}/konfirmasi', [LetterMiskinController::class, 'konfirmasi'])->name('surat-keterangan-miskin.konfirmasi');
    Route::get('/surat-miskin/selesai', [LetterMiskinController::class, 'suratMiskinSelesai'])->name('surat-keterangan-miskin.selesai');
    Route::get('/surat-miskin/{id}/pdf', [LetterMiskinController::class, 'cetak'])->name('surat-miskin.pdf');


    // surat keterangan meninggal
    Route::post('/surat-keterangan-meninggal-dunia/{id}/konfirmasi', [LetterMeninggalController::class, 'konfirmasi'])->name('surat-keterangan-meninggal-dunia.konfirmasi');
    Route::get('/surat-keterangan-kematian/selesai', [LetterMeninggalController::class, 'suratMeninggalSelesai'])->name('suratMeninggal.selesai');
    Route::get('/surat-kematian/{id}/pdf', [LetterMeninggalController::class, 'cetak'])->name('surat-keterangan-meninggal-dunia.pdf');
});


Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // users
    Route::resource('/user', UserController::class);


    // testimoni
    Route::resource('/testimoni', TestimoniController::class)->only('create', 'store', 'destroy', 'edit', 'update');



    // pengaturan
    Route::resource('/pengaturan', PengaturansController::class)->only('create', 'store', 'destroy', 'index', 'edit', 'update');

    // beritas
    Route::resource('/berita', NewsController::class)->only('create', 'store', 'destroy', 'update', 'edit');
});


Route::middleware(['auth', 'verified', UserMiddleware::class])->group(function () {
    Route::get('/masyarakat/dashboard', [DashboardController::class, 'masyarakat'])->name('masyarakat.dashboard');
});



Route::middleware(['auth', 'verified', LurahMiddleware::class,])->group(function () {
    Route::get('/lurah/dashboard', [DashboardController::class, 'lurah'])->name('lurah.dashboard');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
