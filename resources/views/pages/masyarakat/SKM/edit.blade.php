@extends('layouts.main')

@section('title', 'Update Pengajuan Surat Keterangan Miskin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Update Pengajuan Surat Keterangan Miskin </h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('surat-keterangan-miskin.index') }}">SKM</a>
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
                            <form class="row"
                                enctype="multipart/form-data"
                                action="{{ route('surat-keterangan-miskin.update', Crypt::encrypt($surat->id)) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nama_pemohon') ? 'has-error' : '' }}">
                                        <label for="nama_pemohon">Nama Pemohon</label>
                                        <input value="{{ $surat->nama_pemohon }}" required type="text"
                                            name="nama_pemohon" class="form-control" id="nama_pemohon"
                                            placeholder="Nama Pemohon">
                                        @error('nama_pemohon')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nik_pemohon') ? 'has-error' : '' }}">
                                        <label for="nik_pemohon">NIK</label>
                                        <input value="{{ $surat->nik_pemohon }}" required type="text"
                                            class="form-control" id="nik_pemohon" name="nik_pemohon"
                                            placeholder="NIK Pemohon">
                                        @error('nik_pemohon')
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
                                        <input value="{{ $surat->tempat_lahir }}" required type="text"
                                            class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Tempat Lahir">
                                        @error('tempat_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input value="{{ $surat->tanggal_lahir }}" required type="date"
                                            class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                        @error('tanggal_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input value="{{ $surat->agama }}" required type="text" class="form-control"
                                            id="agama" name="agama" placeholder="Agama">
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan">kewarganegaraan</label>
                                        <input value="{{ $surat->kewarganegaraan }}" required type="text"
                                            class="form-control" id="kewarganegaraan" name="kewarganegaraan"
                                            placeholder="kewarganegaraan">
                                        @error('kewarganegaraan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
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
                                        <input value="{{ $surat->pekerjaan }}" required type="text"
                                            class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Pekerjaan">
                                        @error('pekerjaan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('keperluan') ? 'has-error' : '' }}">
                                        <label for="keperluan">Keperluan</label>
                                        <input value="{{ $surat->keperluan }}" required type="text"
                                            class="form-control" id="keperluan" name="keperluan"
                                            placeholder="Keperluan">
                                        @error('keperluan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('penghasilan') ? 'has-error' : '' }}">
                                        <label for="penghasilan">Penghasilan</label>
                                        <input value="{{ $surat->penghasilan }}" required type="text"
                                            class="form-control" id="penghasilan" name="penghasilan"
                                            placeholder="Penghasilan">
                                        @error('penghasilan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('jumlah_anggota_keluarga') ? 'has-error' : '' }}">
                                        <label for="jumlah_anggota_keluarga">Jumlah Anggota Keluarga</label>
                                        <input value="{{ $surat->jumlah_anggota_keluarga }}" required type="number"
                                            class="form-control" id="jumlah_anggota_keluarga"
                                            name="jumlah_anggota_keluarga" placeholder="Jumlah Anggota Keluarga">
                                        @error('jumlah_anggota_keluarga')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <input value="{{ $surat->alamat }}" required type="text" class="form-control"
                                            id="alamat" name="alamat" placeholder="Alamat">
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
                                            class="form-control" id="scan_ktp" name="scan_ktp" placeholder="" />
                                        @error('scan_ktp')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_kk') ? 'has-error' : '' }}">
                                        <label for="scan_kk">Scan KK</label>
                                        <input value="{{ old('scan_kk') }}" required type="file" class="form-control"
                                            id="scan_kk" name="scan_kk" placeholder="" />
                                        @error('scan_kk')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('scan_surat_keterangan') ? 'has-error' : '' }}">
                                        <label for="scan_surat_keterangan">Scan Keterangan</label>
                                        <input value="{{ old('scan_surat_keterangan') }}" type="file" class="form-control"
                                            id="scan_surat_keterangan" name="scan_keterangan" placeholder="" />
                                        @error('scan_surat_keterangan')
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
