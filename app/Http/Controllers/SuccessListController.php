<?php

namespace App\Http\Controllers;

use App\Models\LetterMeninggal;
use Illuminate\Http\Request;

class SuccessListController extends Controller
{
    public function suratMeninggalSelesai()
    {
        $surats = LetterMeninggal::with('letter')->orderBy('created_at', 'desc')->get();
        return view('pages.admin.surat-selesai.SKMD.index', compact('surats'));
    }
}
