@extends('layouts.main')

@section('title', 'Surat Masuk')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Surat Masuk</h3>
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
                        <a href="{{ route('surat-masuk.index') }}">Surat Masuk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Surat Masuk
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Type Surat</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Jam Pengajuan</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
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
                                                    @php
                                                        $typeSurat = '';
                                                        $route = '';
                                                        if ($item->letterable_type == 'App\Models\LetterMiskin') {
                                                            $typeSurat = 'Surat Keterangan Tidak Mampu';
                                                            $route = 'surat-keterangan-miskin.show';
                                                        } elseif (
                                                            $item->letterable_type == 'App\Models\LetterMeninggal'
                                                        ) {
                                                            $typeSurat = 'Surat Keterangan Meninggal Dunia';
                                                            $route = 'surat-keterangan-meninggal-dunia.show';
                                                        } elseif (
                                                            $item->letterable_type == 'App\Models\LetterPenghasilan'
                                                        ) {
                                                            $typeSurat = 'Surat Keterangan Penghasilan Orang Tua';
                                                            $route = 'surat-keterangan-penghasilan.show';
                                                        } elseif ($item->letterable_type == 'App\Models\LetterSKCK') {
                                                            $typeSurat = 'Surat Pengantar SKCK';
                                                            $route = 'surat-pengantar-skck.show';
                                                        } elseif (
                                                            $item->letterable_type == 'App\Models\LetterPengantarNikah'
                                                        ) {
                                                            $typeSurat = 'Surat Pengantar Nikah';
                                                            $route = 'surat-pengantar-nikah.show';
                                                        } else {
                                                            $typeSurat = 'Surat Pernyataan Penguasaan Tanah';
                                                            $route = 'surat-pernyataan-penguasaan-tanah.show';
                                                        }
                                                    @endphp

                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>
                                                        {{ $typeSurat }}
                                                    </td>
                                                    <td>{{ Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>{{ Carbon::parse($item->created_at)->translatedFormat('H:i') }}
                                                    </td>
                                                    <td>
                                                        <x-badge :status="$item->status ?? 'sedang diproses'" />
                                                    </td>
                                                    <td>
                                                        @php

                                                            $status = optional($item)->status;

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
                                                    <td>
                                                        <a href="{{ route($route, encrypt($item->letterable_id)) }}"
                                                            type="button" class="btn btn-icon  btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
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
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endpush
