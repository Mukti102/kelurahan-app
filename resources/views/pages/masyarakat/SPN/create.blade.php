@extends('layouts.main')

@section('title', 'Pengajuan Surat Pengantar Nikah')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pengajuan Surat Pengantar Nikah</h3>
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
                            <div class="card-title">Form Pengajuan</div>
                        </div>
                        <div class="card-body">
                            <form class="row" action="{{ route('surat-pengantar-nikah.store') }}" method="POST">
                                @csrf
                                <div class="col-md-2 col-lg-6">
                                    {{-- nama --}}
                                    <div class="form-group {{ $errors->has('nama_lengkap') ? 'has-error' : '' }}">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input value="{{ old('nama_lengkap') }}" required type="text" name="nama_lengkap"
                                            class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" />
                                        @error('nama_lengkap')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nik --}}
                                    <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                                        <label for="nik">NIK</label>
                                        <input value="{{ old('nik') }}" required type="text" name="nik"
                                            class="form-control" id="nik" placeholder="NIK" />
                                        @error('nik')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- jenis kelamin --}}
                                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="" selected disabled>--jenis kelamin--</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- status  --}}
                                    <div class="form-group {{ $errors->has('status_perkawinan') ? 'has-error' : '' }}">
                                        <label for="status_perkawinan">Status</label>
                                        <input value="{{ old('status_perkawinan') }}" required type="text"
                                            name="status_perkawinan" class="form-control" id="status_perkawinan"
                                            placeholder="Tempat Perkawinan" />
                                        @error('status_perkawinan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tempat lahir --}}
                                    <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input value="{{ old('tempat_lahir') }}" required type="text"
                                            name="tempat_lahir" class="form-control" id="tempat_lahir"
                                            placeholder="Tempat Lahir" />
                                        @error('tempat_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tanggal lahir --}}
                                    <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input value="{{ old('tanggal_lahir') }}" required type="date"
                                            class="form-control" id="tanggal_lahir" name="tanggal_lahir" />
                                        @error('tanggal_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- kewarganegaraan --}}
                                    <div class="form-group {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <input value="{{ old('kewarganegaraan') }}" required type="text"
                                            class="form-control" id="kewarganegaraan" name="kewarganegaraan" />
                                        @error('kewarganegaraan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- agama --}}
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input value="{{ old('agama') }}" required type="text" class="form-control"
                                            id="agama" name="agama" placeholder="Agama" />
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- pekerjaan --}}
                                    <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : '' }}">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input value="{{ old('pekerjaan') }}" required type="text"
                                            class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Pekerjaan" />
                                        @error('pekerjaan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- alamat --}}
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <textarea required class="form-control" id="alamat" name="alamat" placeholder="Alamat">{{ old('nama_lengkap') }}</textarea>
                                        @error('alamat')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-6">
                                    <h5>Data Ayah</h5>
                                    {{-- nama ayah --}}
                                    <div class="form-group {{ $errors->has('nama_lengkap_ayah') ? 'has-error' : '' }}">
                                        <label for="nama_lengkap_ayah">Nama Lengkap Ayah</label>
                                        <input value="{{ old('nama_ayah') }}" required type="text"
                                            class="form-control" id="nama_lengkap_ayah" name="nama_lengkap_ayah"
                                            placeholder="Nama Lengkap Ayah" />
                                        @error('nama_lengkap_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nik ayah --}}
                                    <div class="form-group {{ $errors->has('nik_ayah') ? 'has-error' : '' }}">
                                        <label for="nik_ayah">NIK Ayah</label>
                                        <input value="{{ old('nik_ayah') }}" required type="text"
                                            class="form-control" id="nik_ayah" name="nik_ayah"
                                            placeholder="NIK Ayah" />
                                        @error('nik_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tempat lahir ayah --}}
                                    <div class="form-group {{ $errors->has('tempat_lahir_ayah') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                                        <input value="{{ old('tempat_lahir_ayah') }}" required type="text"
                                            class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                            placeholder="Tempat Lahir Ayah" />
                                        @error('tempat_lahir_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tanggal lahir ayah --}}
                                    <div class="form-group {{ $errors->has('tanggal_lahir_ayah') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                        <input value="{{ old('tanggal_lahir_ayah') }}" required type="date"
                                            class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" />
                                        @error('tanggal_lahir_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- kearganegaraan --}}
                                    <div class="form-group {{ $errors->has('kewarganegaraan_ayah') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan_ayah">Kewarganegaraan Ayah</label>
                                        <input value="{{ old('kewarganegaraan_ayah') }}" required type="text"
                                            class="form-control" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah"
                                            placeholder="kewarganegaraan Ayah" />
                                        @error('kewarganegaraan_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- agama --}}
                                    <div class="form-group {{ $errors->has('agama_ayah') ? 'has-error' : '' }}">
                                        <label for="agama_ayah">Agama Ayah</label>
                                        <input value="{{ old('agama_ayah') }}" required type="text"
                                            class="form-control" id="agama_ayah" name="agama_ayah"
                                            placeholder="agama Ayah" />
                                        @error('agama_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- pekerjaan --}}
                                    <div class="form-group {{ $errors->has('pekerjaan_ayah') ? 'has-error' : '' }}">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                        <input value="{{ old('pekerjaan_ayah') }}" required type="text"
                                            class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                            placeholder="Pekerjaan Ayah" />
                                        @error('pekerjaan_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat_ayah') ? 'has-error' : '' }}">
                                        <label for="alamat_ayah">Alamat Ayah</label>
                                        <textarea required class="form-control" id="alamat_ayah" name="alamat_ayah" placeholder="Alamat Ayah"></textarea>
                                        @error('alamat_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <h5>Data Ibu</h5>
                                    <div class="form-group {{ $errors->has('nama_lengkap_ibu') ? 'has-error' : '' }}">
                                        <label for="nama_lengkap_ibu">Nama Lengkap Ibu</label>
                                        <input value="{{ old('nama_lengkap_ibu') }}" required type="text"
                                            class="form-control" id="nama_lengkap_ibu" name="nama_lengkap_ibu"
                                            placeholder="Nama Lengkap Ibu" />
                                        @error('nama_lengkap_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nik ibu --}}
                                    <div class="form-group {{ $errors->has('nik_ibu') ? 'has-error' : '' }}">
                                        <label for="nik_ibu">NIK Ibu</label>
                                        <input value="{{ old('nik_ibu') }}" required type="text" class="form-control"
                                            id="nik_ibu" name="nik_ibu" placeholder="NIK Ibu" />
                                        @error('nik_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- ttl ibu --}}
                                    <div class="form-group {{ $errors->has('tempat_lahir_ibu') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                                        <input value="{{ old('tempat_lahir_ibu') }}" required type="text"
                                            class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                            placeholder="Tempat Lahir Ibu" />
                                        @error('tempat_lahir_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- ttl ibu --}}
                                    <div class="form-group {{ $errors->has('tanggal_lahir_ibu') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                                        <input value="{{ old('tanggal_lahir_ibu') }}" required type="date"
                                            class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" />
                                        @error('tanggal_lahir_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- kewarga ibu --}}
                                    <div class="form-group {{ $errors->has('kewarganegaraan_ibu') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan_ibu">Kewarganegaraan Ibu</label>
                                        <input value="{{ old('kewarganegaraan_ibu') }}" required type="text"
                                            class="form-control" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu"
                                            placeholder="kewarganegaraan Ibu" />
                                        @error('kewarganegaraan_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- pekerjaan ibu --}}
                                    <div class="form-group {{ $errors->has('pekerjaan_ibu') ? 'has-error' : '' }}">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <input value="{{ old('pekerjaan_ibu') }}" required type="text"
                                            class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                            placeholder="Pekerjaan Ibu" />
                                        @error('pekerjaan_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- alamat ibu --}}
                                    <div class="form-group {{ $errors->has('alamat_ibu') ? 'has-error' : '' }}">
                                        <label for="alamat_ibu">Alamat Ibu</label>
                                        <textarea required class="form-control" id="alamat_ibu" name="alamat_ibu" placeholder="Alamat Ibu"></textarea>
                                        @error('alamat_ibu')
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
