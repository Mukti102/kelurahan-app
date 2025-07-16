@extends('layouts.main')

@section('title', 'Pengajuan Surat Keterangan Meninggal Dunia')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pengajuan Surat Keterangan Meninggal Dunia </h3>
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
                        <a href="{{ route('surat-keterangan-meninggal-dunia.index') }}">SKMD</a>
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
                            <form class="row" enctype="multipart/form-data" action="{{ route('surat-keterangan-meninggal-dunia.store') }}"
                                method="POST">
                                @csrf
                                <div class="col-md-2 col-lg-6">
                                    <div class="form-group {{ $errors->has('nama_almarhum') ? 'has-error' : '' }}">
                                        <label for="nama_almarhum">Nama Almarhum</label>
                                        <input value="{{ old('nama_almarhum') }}" required type="text"
                                            name="nama_almarhum" class="form-control" id="nama_almarhum"
                                            placeholder="Nama Almarhum" />
                                        @error('nama_almarhum')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input value="{{ old('tempat_lahir') }}" required type="text"
                                            class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Tempat Lahir Almarhum" />
                                        @error('tempat_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group  {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input value="{{ old('tanggal_lahir') }}" required type="date"
                                            class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            placeholder="Tanggal Lahir Almarhum" />
                                        @error('tanggal_lahir')
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
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input value="{{ old('agama') }}" required type="text" class="form-control"
                                            id="agama" name="agama" placeholder="Agama" />
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group  {{ $errors->has('kewarganegaraan') ? 'has-error' : '' }}">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <input value="{{ old('kewarganegaraan') }}" required type="text"
                                            class="form-control" id="kewarganegaraan" name="kewarganegaraan"
                                            placeholder="Kewarganegaraan" />
                                        @error('kewarganegaraan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-6">
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <input value="{{ old('alamat') }}" required type="text" class="form-control"
                                            id="alamat" name="alamat" placeholder="Alamat" />
                                        @error('alamat')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_meninggal') ? 'has-error' : '' }}">
                                        <label for="tanggal_meninggal">Tanggal Meninggal</label>
                                        <input value="{{ old('tanggal_meninggal') }}" required type="date"
                                            class="form-control" id="tanggal_meninggal" name="tanggal_meninggal"
                                            placeholder="Tanggal Meninggal" />
                                        @error('tanggal_meninggal')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tempat_kematian') ? 'has-error' : '' }}">
                                        <label for="tempat_kematian">Tempat Meninggal</label>
                                        <input value="{{ old('tempat_kematian') }}" required type="text"
                                            class="form-control" id="tempat_kematian" name="tempat_kematian"
                                            placeholder="Tempat Meninggal" />
                                        @error('tempat_kematian')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('penyebab_meninggal') ? 'has-error' : '' }}">
                                        <label for="penyebab_meninggal">Penyebab Meninggal</label>
                                        <input value="{{ old('penyebab_meninggal') }}" required type="text"
                                            class="form-control" id="penyebab_meninggal" name="penyebab_meninggal"
                                            placeholder="Penyebab Meninggal" />
                                        @error('penyebab_meninggal')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tempat_pemakaman') ? 'has-error' : '' }}">
                                        <label for="tempat_pemakaman">Tempat Pemakaman</label>
                                        <input value="{{ old('tempat_pemakaman') }}" required type="text"
                                            class="form-control" id="tempat_pemakaman" name="tempat_pemakaman"
                                            placeholder="Penyebab Meninggal" />
                                        @error('tempat_pemakaman')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_pembumikan') ? 'has-error' : '' }}">
                                        <label for="tanggal_pembumikan">Di Kebumikan Pada Tanggal</label>
                                        <input value="{{ old('tanggal_pembumikan') }}" required type="date"
                                            class="form-control" id="tanggal_pembumikan" name="tanggal_pembumikan"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('tanggal_pembumikan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <h5 style="font-weight:bolder" class="text-primary fs-5 mt-4">Syarat Berkas Yang Harus Di Unggah</h5>
                                        <p class="fs-6 text-secondary">**Syarat Berkas Yang Harus Di Unggah dalam bentuk format PNG/JPE/JPEG/PDF</p>
                                    </div>
                                    {{-- berkas --}}
                                    <div class="form-group {{ $errors->has('scan_ktp') ? 'has-error' : '' }}">
                                        <label for="scan_ktp">Scan KTP Almarhum/Almarhumah</label>
                                        <input value="{{ old('scan_ktp') }}" required type="file"
                                            class="form-control" id="scan_ktp" name="scan_ktp"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_ktp')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_kk') ? 'has-error' : '' }}">
                                        <label for="scan_kk">Scan KK Almarhum/Almarhumah</label>
                                        <input value="{{ old('scan_kk') }}" required type="file"
                                            class="form-control" id="scan_kk" name="scan_kk"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_kk')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_surat_keterangan_rm') ? 'has-error' : '' }}">
                                        <label for="scan_surat_keterangan_rm">Scan Surat Keterangan Rumah Sakit (Jika Ada)</label>
                                        <input value="{{ old('scan_surat_keterangan_rm') }}" type="file"
                                            class="form-control" id="scan_surat_keterangan_rm" name="scan_surat_keterangan_rm"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_surat_keterangan_rm')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_ktp_pelapor') ? 'has-error' : '' }}">
                                        <label for="scan_ktp_pelapor">Scan KTP Pelapor/Pemohon</label>
                                        <input value="{{ old('scan_ktp_pelapor') }}" required type="file"
                                            class="form-control" id="scan_ktp_pelapor" name="scan_ktp_pelapor"
                                            placeholder="Di Kebumikan Pada Tanggal" />
                                        @error('scan_ktp_pelapor')
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
