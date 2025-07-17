@extends('layouts.main')

@section('title', 'Pengajuan Surat Penguasaan Tanah')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Update Pengajuan Surat Penguasaan Tanah</h3>
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
                        <a href="{{ route('surat-pernyataan-penguasaan-tanah.index') }}">SPPFBT</a>
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
                            <form class="row" enctype="multipart/form-data"
                                action="{{ route('surat-pernyataan-penguasaan-tanah.update', Crypt::encrypt($surat->id)) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="col-md-2 col-lg-6">
                                    <div class="form-group {{ $errors->has('nama_pemohon') ? 'has-error' : '' }}">
                                        <label for="nama_pemohon">Nama Pemohon</label>
                                        <input required type="text" name="nama_pemohon" class="form-control"
                                            id="nama_pemohon" placeholder="Nama Pemohon"
                                            value="{{ $surat->nama_pemohon }}" />
                                        @error('nama_pemohon')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('umur') ? 'has-error' : '' }}">
                                        <label for="umur">Umur</label>
                                        <input required type="number" name="umur" class="form-control" id="umur"
                                            placeholder="Umur" value="{{ $surat->umur }}" />
                                        @error('umur')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input required type="text" name="agama" class="form-control" id="agama"
                                            placeholder="agama" value="{{ $surat->agama }}" />
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- jenis kelamin --}}
                                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="" selected disabled>--jenis kelamin--</option>
                                            <option {{ $surat->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}
                                                value="laki-laki">Laki-Laki</option>
                                            <option {{ $surat->jenis_kelamin == 'perempuan' ? 'selected' : '' }}
                                                value="perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : '' }}">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input required type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                                            placeholder="pekerjaan" value="{{ $surat->pekerjaan }}" />
                                        @error('pekerjaan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <input required type="text" name="alamat" class="form-control" id="alamat"
                                            placeholder="Alamat" value="{{ $surat->alamat }}" />
                                        @error('alamat')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('lokasi_tanah') ? 'has-error' : '' }}">
                                        <label for="lokasi_tanah">Lokasi Tanah</label>
                                        <input required type="text" name="lokasi_tanah" class="form-control"
                                            id="lokasi_tanah" placeholder="Lokasi Tanah"
                                            value="{{ $surat->lokasi_tanah }}" />
                                        @error('lokasi_tanah')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('luas_tanah') ? 'has-error' : '' }}">
                                        <label for="luas_tanah">Luas Tanah</label>
                                        <input required type="number" name="luas_tanah" class="form-control"
                                            id="luas_tanah" placeholder="Luas Tanah" value="{{ $surat->luas_tanah }}" />
                                        @error('luas_tanah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('harga_tanah') ? 'has-error' : '' }}">
                                        <label for="harga_tanah">Harga Tanah</label>
                                        <input required type="text" name="harga_tanah" class="form-control"
                                            id="harga_tanah" placeholder="Harga Tanah"
                                            value="{{ $surat->harga_tanah }}" />
                                        @error('harga_tanah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('status_tanah') ? 'has-error' : '' }}">
                                        <label for="status_tanah">Status Tanah</label>
                                        <input required type="text" name="status_tanah" class="form-control"
                                            id="status_tanah" placeholder="Status Tanah"
                                            value="{{ $surat->status_tanah }}" />
                                        @error('status_tanah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('digunakan_tanah') ? 'has-error' : '' }}">
                                        <label for="digunakan_tanah">Digunakan Tanah</label>
                                        <input required type="text" name="digunakan_tanah" class="form-control"
                                            id="digunakan_tanah" placeholder="Digunakan Tanah"
                                            value="{{ $surat->digunakan_tanah }}" />
                                        @error('digunakan_tanah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-6">
                                    <h5>Data Batas Tanah</h5>
                                    <div class="form-group {{ $errors->has('batas_barat') ? 'has-error' : '' }}">
                                        <label for="batas_barat">Batas Barat</label>
                                        <input required type="text" name="batas_barat" class="form-control"
                                            id="batas_barat" placeholder="Batas Barat"
                                            value="{{ $surat->batas_barat }}" />
                                        @error('batas_barat')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('batas_timur') ? 'has-error' : '' }}">
                                        <label for="batas_timur">Batas Timur</label>
                                        <input required type="text" name="batas_timur" class="form-control"
                                            id="batas_timur" placeholder="Batas Timur"
                                            value="{{ $surat->batas_timur }}" />
                                        @error('batas_timur')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('batas_utara') ? 'has-error' : '' }}">
                                        <label for="batas_utara">Batas Utara</label>
                                        <input required type="text" name="batas_utara" class="form-control"
                                            id="batas_utara" placeholder="Batas Utara"
                                            value="{{ $surat->batas_utara }}" />
                                        @error('batas_utara')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('batas_selatan') ? 'has-error' : '' }}">
                                        <label for="batas_selatan">Batas Selatan</label>
                                        <input required type="text" name="batas_selatan" class="form-control"
                                            id="batas_selatan" placeholder="Batas Selatan"
                                            value="{{ $surat->batas_selatan }}" />
                                        @error('batas_selatan')
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
                                        <label for="scan_ktp">Scan KTP Pemohon</label>
                                        <input value="{{ old('scan_ktp') }}" type="file" class="form-control"
                                            id="scan_ktp" name="scan_ktp" placeholder="" />
                                        @error('scan_ktp')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_kk') ? 'has-error' : '' }}">
                                        <label for="scan_kk">Scan Kartu Keluarga (KK)</label>
                                        <input value="{{ old('scan_kk') }}" type="file" class="form-control"
                                            id="scan_kk" name="scan_kk" placeholder="" />
                                        @error('scan_kk')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_SPPT_PBB') ? 'has-error' : '' }}">
                                        <label for="scan_SPPT_PBB">Scan SPPT PBB ( Jika Ada )</label>
                                        <input value="{{ old('scan_SPPT_PBB') }}" type="file" class="form-control"
                                            id="scan_SPPT_PBB" name="scan_SPPT_PBB" placeholder="" />
                                        @error('scan_SPPT_PBB')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('scan_surat_bukti') ? 'has-error' : '' }}">
                                        <label for="scan_surat_bukti">Scan SPPT PBB ( Opsional )</label>
                                        <input value="{{ old('scan_surat_bukti') }}" type="file" class="form-control"
                                            id="scan_surat_bukti" name="scan_surat_bukti" placeholder="" />
                                        @error('scan_surat_bukti')
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
