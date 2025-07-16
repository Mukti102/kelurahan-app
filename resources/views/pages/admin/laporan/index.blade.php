@extends('layouts.main')

@section('title', 'Rekap Laporan')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container">

        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Rekap Laporan</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}">Rekap Laporan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-0 col-md-5">
                    <div class="card shadow-sm">
                        <div class="card-footer">
                            <div class="row">
                                <!-- Kolom Form -->
                                <div class="col-md-12 mb-3">
                                    <form action="{{ route('laporan.index') }}" method="GET" class="me-3">
                                        @method('GET')
                                        @csrf
                                        <div>
                                            <label for="mulai" class="form-label mb-1">Mulai Tanggal</label>
                                            <input type="date" class="form-control" name="mulai" id="mulai">
                                        </div>
                                        <div class="mt-2">
                                            <label for="akhir" class="form-label mb-1">Sampai Tanggal</label>
                                            <input type="date" class="form-control" name="akhir" id="akhir">
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn px-4 btn-label-success btn-round btn-sm me-2">
                                                <span class="btn-label">
                                                    <i class="fas fa-filter"></i>
                                                </span>
                                                Filter
                                            </button>
                                            <a href="{{ route('laporan.print', ['mulai' => request('mulai'), 'akhir' => request('akhir')]) }}"
                                                class="btn px-4 btn-label-warning btn-round btn-sm me-2">
                                                <span class="btn-label">
                                                    <i class="fa fa-print"></i>
                                                </span>
                                                Print
                                            </a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Laporan Semua Surat
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>No Surat</th>
                                            <th>Surat</th>
                                            <th>Nama Pengaju</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($surats->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    Tidak ada data yang tersedia.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($surats as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                    </td>
                                                    @php
                                                        $letterShortName;
                                                        $letterType;
                                                        if ($item->letterable_type == 'App\Models\LetterMiskin') {
                                                            $letterShortName = 'SKM';
                                                            $letterType = 'Surat Keterangan Tidak Mampu';
                                                        } elseif (
                                                            $item->letterable_type == 'App\Models\LetterMeninggal'
                                                        ) {
                                                            $letterShortName = 'SKMD';
                                                            $letterType = 'Surat Keterangan Meninggal Dunia';
                                                        } elseif (
                                                            $item->letterable_type == 'App\Models\LetterPenghasilan'
                                                        ) {
                                                            $letterShortName = 'SKP-OT';
                                                            $letterType = 'Surat Keterangan Penghasilan Orang Tua';
                                                        } elseif ($item->letterable_type == 'App\Models\LetterSKCK') {
                                                            $letterShortName = 'SPKCK';
                                                            $letterType = 'Surat Pengantar SKCK';
                                                        } elseif ($item->letterable_type == 'App\Models\LetterNikah') {
                                                            $letterShortName = 'SPN';
                                                            $letterType = 'Surat Pengantar Nikah';
                                                        } else {
                                                            $letterShortName = 'SKT';
                                                            $letterType = 'Surat Keterangan Tanah';
                                                        }
                                                    @endphp
                                                    <td>
                                                        {{ str_pad($item->letterable_id, 3, '0', STR_PAD_LEFT) }}/{{ $letterShortName }}/2001/{{ \Carbon\Carbon::now()->format('Y') }}
                                                    </td>


                                                    <td>
                                                        {{ $letterType }}
                                                    </td>
                                                    <td>
                                                        {{ $item->user->name }}
                                                    </td>

                                                    <td>
                                                        <x-badge :status="$item->letter->status ?? 'sedang diproses'" />
                                                    </td>
                                                    <td>
                                                        @php
                                                            $status = optional($item->letter)->status;
                                                            if ($status == 'sedang diproses' || $status == null) {
                                                                $keterangan = 'Sedang diproses...';
                                                            } elseif ($status == 'menunggu tanda tangan') {
                                                                $keterangan = 'Menunggu tanda tangan Lurah';
                                                            } elseif ($status == 'sudah dikonfirmasi') {
                                                                $keterangan = 'Data Belum Lengkap';
                                                            } else {
                                                                $keterangan = 'Surat Siap Untuk Di Ambil';
                                                            }
                                                        @endphp
                                                        {{ $keterangan }}

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @dd($surats)  --}}

    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endpush
