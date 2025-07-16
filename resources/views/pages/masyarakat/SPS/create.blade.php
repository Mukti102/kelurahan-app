@extends('layouts.main')

@section('title', 'Pengajuan Surat Pengantar SKSK')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pengajuan Surat Pengantar SKSK</h3>
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
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Pengajuan</div>
                        </div>
                        <div class="card-body">
                            <form class="row" enctype="multipart/form-data" action="{{ route('surat-pengantar-skck.store') }}" method="POST">
                                @csrf
                                <div class="col-md-2 col-lg-6">
                                    <div class="form-group {{ $errors->has('nama_pemohon') ? 'has-error' : '' }}">
                                        <label for="nama_pemohon">Nama Pemohon</label>
                                        <input required type="text" name="nama_pemohon" class="form-control"
                                            id="nama_pemohon" placeholder="Nama Pemohon" />
                                        @error('nama_pemohon')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nik_pemohon') ? 'has-error' : '' }}">
                                        <label for="nik_pemohon">NIK Pemohon</label>
                                        <input required type="text" name="nik_pemohon" class="form-control"
                                            id="nik_pemohon" placeholder="NIK Pemohon" />
                                        @error('nik_pemohon')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <input required type="text" name="kewarganegaraan" class="form-control"
                                            id="kewarganegaraan" placeholder="NIK Pemohon" />
                                        @error('kewarganegaraan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="laki-laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input required type="text" class="form-control" id="tempat_lahir"
                                            name="tempat_lahir" placeholder="Tempat Lahir Pemohon" />
                                        @error('tempat_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input required type="date" class="form-control" id="tanggal_lahir"
                                            name="tanggal_lahir" />
                                        @error('tanggal_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input required type="text" class="form-control" id="agama" name="agama"
                                            placeholder="Agama Pemohon" />
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-6">
                                    <div class="form-group {{ $errors->has('status_perkawinan') ? 'has-error' : '' }}">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <select class="form-select" id="status_perkawinan" name="status_perkawinan">
                                            <option value="kawin">Kawin</option>
                                            <option value="belum kawin">Belum Kawin</option>
                                        </select>
                                        @error('status_perkawinan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : '' }}">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input required type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Pekerjaan Pemohon" />
                                        @error('pekerjaan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('keperluan') ? 'has-error' : '' }}">
                                        <label for="keperluan">Keperluan</label>
                                        <input required type="text" class="form-control" id="keperluan"
                                            name="keperluan" placeholder="Keperluan" />
                                        @error('keperluan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <textarea required type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat"></textarea>
                                        @error('alamat')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div>
                                        <h5 style="font-weight:bolder" class="text-primary fs-5 mt-4">Syarat Berkas Yang
                                            Harus Di Unggah</h5>
                                        <p class="fs-6 text-secondary">**Syarat Berkas Yang Harus Di Unggah dalam bentuk
                                            format PNG/JPE/JPEG/PDF</p>
                                    </div>
                                    {{-- berkas --}}
                                    <div class="form-group {{ $errors->has('scan_ktp') ? 'has-error' : '' }}">
                                        <label for="scan_ktp">Scan KTP</label>
                                        <input value="{{ old('scan_ktp') }}" required type="file"
                                            class="form-control" id="scan_ktp" name="scan_ktp"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_ktp')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_kk') ? 'has-error' : '' }}">
                                        <label for="scan_kk">Scan KK</label>
                                        <input value="{{ old('scan_kk') }}" required type="file" class="form-control"
                                            id="scan_kk" name="scan_kk" placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_kk')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-action mt-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" onclick="window.history.back()"
                                        class="btn btn-danger">Kembali</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
