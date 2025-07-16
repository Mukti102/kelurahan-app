@extends('layouts.main')

@section('title', 'Data Penduduk')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Penduduk</h3>
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
                        <a href="{{ route('penduduk.index') }}">penduduk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data penduduk</h4>
                            {{-- Tombol Tambah --}}
                            <a href="{{ route('penduduk.create') }}" class="btn btn-sm  btn-primary">
                                <i class="fas fa-plus me-1"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Status Penduduk</th>
                                            <th>Umur</th>
                                            <th>Phone</th>
                                            <th>Avatar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($penduduks->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    Tidak ada data yang tersedia.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($penduduks as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_lengkap }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->status_penduduk }}</td>
                                                    <td>{{ Carbon::parse($item->tanggal_lahir)->age }} tahun</td>
                                                    <td>{{ $item->alamat->telepon }}</td>

                                                    <td>
                                                        <div class="avatar-sm">
                                                            <img src="{{ 'storage/' . $item->photo }}"
                                                                class="avatar-img  shadow-sm" alt="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{ route('penduduk.edit', $item) }}" type="button"
                                                                class="btn btn-icon  btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('penduduk.destroy', $item->id) }}"
                                                                method="POST" onsubmit="return confirmDelete(event)">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-icon  btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
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
