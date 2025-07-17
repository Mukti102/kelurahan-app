@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Pengantar SKCK')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Detail Pengajuan Surat Pengantar SKCK</h3>
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
                        <a href="{{ route('surat-pengantar-skck.index') }}">SPS</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Surat Pengantar SKCK</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Detail Surat -->
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">Nomor Surat</th>
                                                <td>123/SKM/2025</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pemohon</th>
                                                <td>{{ $surat->nama_pemohon }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>{{ $surat->nik_pemohon }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>{{ $surat->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat/Tanggal Lahir</th>
                                                <td>{{ $surat->tempat_lahir }},
                                                    {{ Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Agama</th>
                                                <td>{{ $surat->agama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kewarganegaraan</th>
                                                <td>{{ $surat->kewarganegaraan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Perkawinan</th>
                                                <td>{{ $surat->status_perkawinan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td>{{ $surat->pekerjaan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Keperluan</th>
                                                <td>{{ $surat->keperluan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>{{ $surat->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Berkas</th>
                                                <td>

                                                    @php
                                                        $berkas = is_string($surat->letter->berkas)
                                                            ? json_decode($surat->letter->berkas, true)
                                                            : $surat->letter->berkas;
                                                    @endphp

                                                    @foreach ($berkas as $file)
                                                        <div class="mb-2">
                                                            <strong>{{ ucwords(str_replace('_', ' ', $file['name'] ?? '_')) }}</strong><br>
                                                            @if (!empty($file['path']))
                                                                <a href="{{ asset('storage/' . $file['path']) }}"
                                                                    target="_blank" class="text-blue-500 underline">
                                                                    Lihat File
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endforeach


                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <!-- Kolom Form -->
                                <div class="col-md-12 mb-3">
                                    <form
                                        action="{{ route('surat-pengantar-skck.konfirmasi', Crypt::encrypt($surat->id)) }}"
                                        method="POST" class="me-3">
                                        @method('POST')
                                        @csrf
                                        <label for="keterangan" class="form-label mb-1">Keterangan</label>
                                        <select class="form-select form-control-default" id="keterangan" name="keterangan">
                                            <option>Data Lengkap</option>
                                            <option>Data Belum Lengkap</option>
                                        </select>
                                        <button class="btn mt-3 btn-success w-100 btn-rounded btn-sm align-self-start"
                                            type="submit">
                                            Konfirmasi Pengajuan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
