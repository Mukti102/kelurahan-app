@extends('layouts.main')

@section('title', 'Pengajuan Surat Keterangan Penghasilan')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pengajuan Surat Keterangan Penghasilan</h3>
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
                        <a href="{{ route('surat-keterangan-penghasilan.index') }}">SKP</a>
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
                            <form class="row" action="{{ route('surat-keterangan-penghasilan.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nama_pemohon') ? 'has-error' : '' }}">
                                        <label for="nama_pemohon">Nama Pemohon</label>
                                        <input required type="text" name="nama_pemohon" class="form-control"
                                            id="nama_pemohon" placeholder="Nama Pemohon" />
                                        @error('nama_pemohon')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nik_pemohon') ? 'has-error' : '' }}">
                                        <label for="nik_pemohon">Nik Pemohon</label>
                                        <input required type="text" name="nik_pemohon" class="form-control"
                                            id="nik_pemohon" placeholder="NIK Pemohon" />
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
                                        <input required type="text" name="tempat_lahir" class="form-control"
                                            id="tempat_lahir" placeholder="Tempat Lahir" />
                                        @error('tempat_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input required type="date" name="tanggal_lahir" class="form-control"
                                            id="tanggal_lahir" placeholder="Tempat Lahir" />
                                        @error('tanggal_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <input required type="text" name="agama" class="form-control" id="agama"
                                            placeholder="Agama" />
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : '' }}">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input required type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                                            placeholder="Pekerjaan Pemohon" />
                                        @error('pekerjaan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('penghasilan') ? 'has-error' : '' }}">
                                        <label for="penghasilan">Penghasilan</label>
                                        <input required type="text" name="penghasilan" class="form-control"
                                            id="penghasilan" placeholder="Penghasilan Pemohon" />
                                        @error('penghasilan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('keperluan') ? 'has-error' : '' }}">
                                        <label for="keperluan">Keperluan</label>
                                        <input required type="text" name="keperluan" class="form-control" id="keperluan"
                                            placeholder="keperluan Pemohon" />
                                        @error('keperluan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <textarea cols="10" rows="5" required type="text" name="alamat" class="form-control" id="alamat"
                                            placeholder="Jl... no.."></textarea>
                                        @error('alamat')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('nama_anak') ? 'has-error' : '' }}">
                                        <label for="nama_anak">Nama Anak</label>
                                        <input required type="text" name="nama_anak" class="form-control"
                                            id="nama_anak" placeholder="" />
                                        @error('nama_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nik_anak') ? 'has-error' : '' }}">
                                        <label for="nik_anak">NIK Anak</label>
                                        <input required type="text" name="nik_anak" class="form-control"
                                            id="nik_anak" placeholder="NIK Anak" />
                                        @error('nik_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('jenis_kelamin_anak') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin_anak">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin_anak" name="jenis_kelamin_anak">
                                            <option value="laki-laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tempat_lahir_anak') ? 'has-error' : '' }}">
                                        <label for="tempat_lahir_anak">Tempat Lahir</label>
                                        <input required type="text" name="tempat_lahir_anak" class="form-control"
                                            id="tempat_lahir_anak" placeholder="Tempat Lahir" />
                                        @error('tempat_lahir_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('tanggal_lahir_anak') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir_anak">Tanggal Lahir</label>
                                        <input required type="date" name="tanggal_lahir_anak" class="form-control"
                                            id="tanggal_lahir_anak" placeholder="Tempat Lahir" />
                                        @error('tanggal_lahir_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('agama_anak') ? 'has-error' : '' }}">
                                        <label for="agama_anak">Agama</label>
                                        <input required type="text" name="agama_anak" class="form-control"
                                            id="agama_anak" placeholder="Agama" />
                                        @error('agama_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('pekerjaan_anak') ? 'has-error' : '' }}">
                                        <label for="pekerjaan_anak">Pekerjaan</label>
                                        <input required type="text" name="pekerjaan_anak" class="form-control"
                                            id="pekerjaan_anak" placeholder="Pekerjaan" />
                                        @error('pekerjaan_anak')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('alamat_anak') ? 'has-error' : '' }}">
                                        <label for="alamat_anak">Alamat </label>
                                        <textarea cols="10" rows="5" required type="text" name="alamat_anak" class="form-control"
                                            id="alamat_anak" placeholder="Jl... no.."></textarea>
                                        @error('alamat_anak')
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
