@extends('layouts.main')

@section('title', 'Pengajuan Surat Pengantar Nikah')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Pengajuan Surat Pengantar Nikah</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('masyarakat.dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('surat-pengantar-nikah.index') }}">SPN</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Surat Keterangan Penganta Nikah
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Surat</th>
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
                                                    <td>{{ $item->nama_lengkap }}</td>
                                                    <td>Surat Pengantar Nikah</td>
                                                    <td>
                                                        <x-badge :status="$item->letter->status" />
                                                    </td>
                                                    <td>
                                                        @php
                                                            $keterangan;
                                                            if ($item->letter->status == 'sedang diproses') {
                                                                $keterangan = 'Sedang diproses...';
                                                            } elseif (
                                                                $item->letter->status == 'menunggu tanda tangan'
                                                            ) {
                                                                $keterangan = 'Menunggu tanda tangan Lurah';
                                                            } elseif ($item->letter->status == 'sudah dikonfirmasi') {
                                                                $keterangan = 'Data Belum Lengkap';
                                                            } else {
                                                                $keterangan = 'Surat Siap Untu Di Ambil';
                                                            }
                                                        @endphp
                                                        {{ $keterangan }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group gap-1">
                                                            @if ($item->letter->status == 'sedang diproses' || $item->letter->status == null)
                                                                <a href="{{ route('surat-pengantar-nikah.edit', Crypt::encrypt($item->id)) }}"
                                                                    class="btn btn-icon   btn-warning">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                            @endif
                                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Stop form submission
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu Tidak Bisa Mengembalikan Data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Submit the form if confirmed
                }
            });
        }
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endpush
