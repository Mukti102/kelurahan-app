<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterMeninggal;
use App\Models\LetterMiskin;
use App\Models\LetterPengantarNikah;
use App\Models\LetterPenghasilan;
use App\Models\LetterSKCK;
use App\Models\LetterTanah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $suratsKematian = LetterMeninggal::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();

        $suratsMiskin = LetterMiskin::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();


        $suratsNikah = LetterPengantarNikah::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();

        $suratsPenghasilan = LetterPenghasilan::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();

        $suratsSKCK = LetterSKCK::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();

        $suratsTanah = LetterTanah::whereHas('letter', function ($query) {
            $query->where('status', '!=', 'selesai');
        })->get();

        // data chart 
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $suratsKematians = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsKematians[] = LetterMeninggal::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsMiskins = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsMiskins[] = LetterMiskin::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsNikahs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsNikahs[] = LetterPengantarNikah::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsPenghasilans = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsPenghasilans[] = LetterPenghasilan::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsSKCKs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsSKCKs[] = LetterSKCK::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsTanahs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsTanahs[] = LetterTanah::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }


        return view('pages.admin.dashboard', compact('suratsKematian', 'suratsMiskin', 'suratsNikah', 'suratsPenghasilan', 'suratsSKCK', 'suratsTanah', 'suratsKematians', 'suratsMiskins', 'suratsNikahs', 'suratsPenghasilans', 'suratsSKCKs', 'suratsTanahs', 'bulanLabels'));
    }

    public function masyarakat()
    {
        return view('pages.masyarakat.dashboard');
    }

    public function lurah()
    {
        $suratsKematian = LetterMeninggal::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan');
        })->get();

        $suratsMiskin = LetterMiskin::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan');
        })->get();


        $suratsNikah = LetterPengantarNikah::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan ');
        })->get();

        $suratsPenghasilan = LetterPenghasilan::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan');
        })->get();

        $suratsSKCK = LetterSKCK::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan');
        })->get();

        $suratsTanah = LetterTanah::whereHas('letter', function ($query) {
            $query->where('status', 'menunggu tanda tangan');
        })->get();


        // data chart 
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $suratsKematians = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsKematians[] = LetterMeninggal::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsMiskins = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsMiskins[] = LetterMiskin::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsNikahs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsNikahs[] = LetterPengantarNikah::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsPenghasilans = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsPenghasilans[] = LetterPenghasilan::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsSKCKs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsSKCKs[] = LetterSKCK::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }

        $suratsTanahs = [];
        for ($i = 0; $i < count($bulanLabels); $i++) {
            $suratsTanahs[] = LetterTanah::whereHas('letter', function ($query) use ($i) {
                $query;
            })->whereMonth('created_at', $i + 1)->count();
        }



        return view('pages.lurah.dashboard', compact('suratsKematian', 'suratsMiskin', 'suratsNikah', 'suratsPenghasilan', 'suratsSKCK', 'suratsTanah', 'suratsKematians', 'suratsMiskins', 'suratsNikahs', 'suratsPenghasilans', 'suratsSKCKs', 'suratsTanahs', 'bulanLabels'));
    }
}
