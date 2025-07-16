<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;

use Illuminate\Http\Request;
use App\Models\Letter;
use Dompdf\Options;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Letter::with('letterType');

        // Cek apakah ada input filter tanggal
        if ($request->has('mulai') && $request->has('akhir')) {
            $mulai = $request->input('mulai');
            $akhir = $request->input('akhir');

            if ($mulai && $akhir) {
                $query->whereBetween('created_at', [$mulai, $akhir]);
            }
        }

        $surats = $query->get();



        return view('pages.admin.laporan.index', compact('surats'));
    }

    public function print(Request $request)
    {

        $query = Letter::with('letterType');

        // Cek apakah ada input filter tanggal
        if ($request->has('mulai') && $request->has('akhir')) {
            $mulai = $request->input('mulai');
            $akhir = $request->input('akhir');

            if ($mulai && $akhir) {
                $query->whereBetween('created_at', [$mulai, $akhir]);
            }
        }

        $surats = $query->get();


        $pdf = new Dompdf();

        // Set options (optional, depending on your requirements)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);  // To support HTML5
        $pdf->setOptions($options);

        $html = view('pages.admin.laporan.printLaporan', compact('surats'))->render();
        // Load HTML content into the PDF
        $pdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render PDF (first pass)
        $pdf->render();

        // Stream the generated PDF to the browser for printing
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            "Content-Type" => "application/pdf",
            "Content-Disposition" => "inline; filename=sample.pdf"
        ]);
    }
}
