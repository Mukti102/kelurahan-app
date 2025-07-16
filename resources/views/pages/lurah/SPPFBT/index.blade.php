@extends('layouts.main')

@section('title', 'Pengajuan Surat Pernyataan Penguasaan Tanah')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Pengajuan Surat Pernyataan Penguasaan Tanah</h3>
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
                        <a href="{{ route('surat-pernyataan-penguasaan-tanah.index') }}">SKP</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Surat Pernyataan Penguasaan Tanah
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Nama</th>
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
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>{{ $item->letter->user->name }}</td>
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
                                                    <td>
                                                        <a href="{{ route('surat-pernyataan-penguasaan-tanah.show', Crypt::encrypt($item->id)) }}"
                                                            class="btn btn-xs btn-primary">
                                                            <span class="btn-label">
                                                                <i class="fas fa-eye"></i>
                                                            </span>
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
