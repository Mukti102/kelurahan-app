@extends('layouts.main')

@section('title', 'Tambah Penduduk Baru')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tambah Penduduk Baru</h3>
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
                        <a href="{{ route('penduduk.index') }}">penduduk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form penduduk</div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="row" action="{{ route('penduduk.store') }}"
                                method="POST">
                                @csrf
                                <div class="col-md-6">
                                    {{-- photo card --}}
                                    <div class="col-md-6">
                                        <div class="card shadow-sm">
                                            <div class="card-body text-center">
                                                <img style="height: 12rem;object-fit: cover" id="preview"
                                                    src="https://aplikasi-desa.genera.my.id/assets/images/pengguna/kuser.png"
                                                    alt="Profile Photo" class="img-fluid rounded">
                                            </div>
                                            <div class="card-footer text-center">
                                                <input type="file" name="photo" id="photoInput" class="d-none"
                                                    accept="image/*">
                                                <label style="color: white;width: 100%" for="photoInput"
                                                    class="btn w-full btn-primary d-block text-white">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-3">Data Pribadi</h5>
                                    <div class="form-group {{ $errors->has('nama_lengkap') ? 'has-error' : '' }}">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input value="{{ old('nama_lengkap') }}" required type="text" name="nama_lengkap"
                                            class="form-control" id="nama_lengkap" placeholder="Nama Pemohon" />
                                        @error('nama_lengkap')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                                        <label for="nik">NIK</label>
                                        <input value="{{ old('nik') }}" required type="number" name="nik"
                                            class="form-control" id="nik" placeholder="NIK" />
                                        @error('nik')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- jenis kelamin --}}
                                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select" id="formGroupDefaultSelect">
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
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
                                    <div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input value="{{ old('tanggal_lahir') }}" required type="date"
                                            name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                            placeholder="Tanggal Lahir" />
                                        @error('tanggal_lahir')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- agama --}}
                                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                                        <label for="agama">Agama</label>
                                        <select name="agama" class="form-select" id="formGroupDefaultSelect">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                        </select>
                                        @error('agama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- status penduduk --}}
                                    <div class="form-group {{ $errors->has('status_penduduk') ? 'has-error' : '' }}">
                                        <label for="status_penduduk">Status Penduduk</label>
                                        <select name="status_penduduk" class="form-select" id="formGroupDefaultSelect">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="asli">Asli</option>
                                            <option value="kontrak">Kontrak</option>
                                            <option value="pindah">Pindah</option>
                                            <option value="pendatang">Pendatang</option>
                                            <option value="meninggal">Meninggal</option>
                                        </select>
                                        @error('status_penduduk')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- hubungan keluarga --}}
                                    <div class="form-group {{ $errors->has('hubungan_keluarga') ? 'has-error' : '' }}">
                                        <label for="hubungan_keluarga">Hubungan Keluarga Sesuai KK</label>
                                        <select name="hubungan_keluarga" class="form-select" id="">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                                            <option value="Suami">Suami</option>
                                            <option value="Istri">Istri</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Menantu">Menantu</option>
                                            <option value="Cucu">Cucu</option>
                                        </select>
                                        @error('hubungan_keluarga')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- alamat --}}
                                    <h5 class="fw-bold mb-3 mt-4">Data Alamat</h5>
                                    {{-- alamat sekarang --}}
                                    <div class="form-group {{ $errors->has('alamat_sekarang') ? 'has-error' : '' }}">
                                        <label for="alamat_sekarang">Alamat Sekarang</label>
                                        <input value="{{ old('alamat_sekarang') }}" required type="text"
                                            name="alamat_sekarang" class="form-control" id="alamat_sekarang"
                                            placeholder="Alamat Sekarang" />
                                        @error('alamat_sekarang')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('dusun') ? 'has-error' : '' }}">
                                        <label for="dusun">Dusun</label>
                                        <input value="{{ old('dusun') }}" required type="text" name="dusun"
                                            class="form-control" id="dusun" placeholder="Dusun" />
                                        @error('dusun')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- telepon --}}
                                    <div class="form-group {{ $errors->has('telepon') ? 'has-error' : '' }}">
                                        <label for="telepon">Telepon</label>
                                        <input value="{{ old('telepon') }}" required type="text" name="telepon"
                                            class="form-control" id="telepon" placeholder="Telepon" />
                                        @error('telepon')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- email --}}
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email">Email</label>
                                        <input value="{{ old('email') }}" required type="email" name="email"
                                            class="form-control" id="email" placeholder="Email" />
                                        @error('email')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    {{-- perkawinan --}}
                                    <h5 class="fw-bold mb-3 mt-4">Data Perkawinan</h5>
                                    {{-- status perkawinan --}}
                                    <div class="form-group {{ $errors->has('status_perkawinan') ? 'has-error' : '' }}">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <select required name="status_perkawinan" class="form-select"
                                            id="status_perkawinan">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="menikah">Menikah</option>
                                            <option value="belum menikah">Belum Menikah</option>
                                            <option value="duda">Duda</option>
                                            <option value="janda">Janda</option>
                                        </select>
                                        @error('status_perkawinan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tanggal nikah --}}
                                    <div class="form-group {{ $errors->has('tanggal_nikah') ? 'has-error' : '' }}">
                                        <label for="tanggal_nikah">Tanggal Nikah</label>
                                        <input value="{{ old('tanggal_nikah') }}" type="date" name="tanggal_nikah"
                                            class="form-control" id="tanggal_nikah" placeholder="Tanggal Nikah" />
                                        @error('tanggal_nikah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- tanggal cerai --}}
                                    <div class="form-group {{ $errors->has('tanggal_cerai') ? 'has-error' : '' }}">
                                        <label for="tanggal_cerai">Tanggal Cerai</label>
                                        <input value="{{ old('tanggal_cerai') }}" type="date" name="tanggal_cerai"
                                            class="form-control" id="tanggal_cerai" placeholder="Tanggal Cerai" />
                                        @error('tanggal_cerai')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- akta nikah  --}}
                                    <div class="form-group {{ $errors->has('akta_nikah') ? 'has-error' : '' }}">
                                        <label for="akta_nikah">Akta Nikah</label>
                                        <input value="{{ old('no_akta_nikah') }}" type="text" name="no_akta_nikah"
                                            class="form-control" id="no_akta_nikah" placeholder="Akta Nikah" />
                                        @error('akta_nikah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- akta cerai  --}}
                                    <div class="form-group {{ $errors->has('akta_cerai') ? 'has-error' : '' }}">
                                        <label for="akta_cerai">Akta Cerai</label>
                                        <input value="{{ old('no_akta_cerai') }}" type="text" name="no_akta_cerai"
                                            class="form-control" id="no_akta_cerai" placeholder="Akta Cerai" />
                                        @error('akta_cerai')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- pendidikan --}}
                                    <h5 class="fw-bold mb-3 mt-4">Data Pendidikan</h5>
                                    {{-- pendidika terkahir --}}
                                    <div class="form-group {{ $errors->has('pendidikan_terakhir') ? 'has-error' : '' }}">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <select class="form-select" name="pendidikan_terakhir" id="pendidikan_terakhir">
                                            <option value="">-- pilih --</option>
                                            <option value="paud">Paud</option>
                                            <option value="tk">TK</option>
                                            <option value="sd">SD</option>
                                            <option value="smp">SMP</option>
                                            <option value="sma">SMA</option>
                                            <option value="s1">SI</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                            <option value="tidak sekolah">Tidak Sekolah</option>
                                            <option value="belum sekolah">Belum Sekolah</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- pekerjaan --}}
                                    <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : '' }}">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input required type="text" name="pekerjaan" class="form-control"
                                            id="pekerjaan" placeholder="Pekerjaan" />
                                        @error('pekerjaan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <h5 class="fw-bold mb-3 mt-4">Data Kesehatan</h5>
                                    {{-- golongan darah --}}
                                    <div class="form-group {{ $errors->has('golongan_darah') ? 'has-error' : '' }}">
                                        <label for="golongan_darah">Golongan Darah</label>
                                        <select name="golongan_darah" class="form-select" id="">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="tidak tahu">Tidak Tahu</option>
                                        </select>
                                        @error('golongan_darah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- cacat --}}
                                    <div class="form-group {{ $errors->has('cacat') ? 'has-error' : '' }}">
                                        <label for="cacat">Cacat</label>
                                        <select name="cacat" class="form-select" id="">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="cacat fisik">Cacat Fisik</option>
                                            <option value="cacat mental">Cacat Mental</option>
                                            <option value="cacat netra/buta">Cacat Netra/Buta</option>
                                            <option value="cacat rungu/wicara">Cacat Rungu/Wicara</option>
                                            <option value="cacat mental/jiwa">Cacat Mental/Jiwa</option>
                                            <option value="cacat fisik dan mental">Cacat Fisik dan Mental</option>
                                            <option value="cacat lainya">Cacat Lainya</option>
                                            <option value="tidak tahu">Tidak Tahu</option>
                                        </select>
                                        @error('cacat')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- asuransi kesehatan --}}
                                    <div class="form-group {{ $errors->has('asuransi_kesehatan') ? 'has-error' : '' }}">
                                        <label for="asuransi_kesehatan">Asuransi Kesehatan</label>
                                        <select name="asuransi_kesehatan" class="form-select" id="">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="bpjs">BPJS</option>
                                            <option value="belum punya">Belum Punya</option>
                                            <option value="jamsostek">Jamsostek</option>
                                            <option value="kesehatan masyarakat">Kesehatan Masyarakat</option>
                                            <option value="lainya">Lainya</option>
                                        </select>
                                        @error('asuransi_kesehatan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- keluarga --}}
                                    <h5 class="fw-bold mb-3 mt-5">Data Keluarga</h5>
                                    {{-- nik ayah --}}
                                    <div class="form-group {{ $errors->has('nik_ayah') ? 'has-error' : '' }}">
                                        <label for="nik_ayah">NIK Ayah</label>
                                        <input required type="text" name="nik_ayah" class="form-control"
                                            id="nik_ayah" placeholder="NIK Ayah" />
                                        @error('nik_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nama ayah --}}
                                    <div class="form-group {{ $errors->has('nama_ayah') ? 'has-error' : '' }}">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <input required type="text" name="nama_ayah" class="form-control"
                                            id="nama_ayah" placeholder="Nama Ayah" />
                                        @error('nama_ayah')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nik ibu --}}
                                    <div class="form-group {{ $errors->has('nik_ibu') ? 'has-error' : '' }}">
                                        <label for="nik_ibu">NIK Ibu</label>
                                        <input required type="text" name="nik_ibu" class="form-control"
                                            id="nik_ibu" placeholder="NIK Ibu" />
                                        @error('nik_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- nama ibu --}}
                                    <div class="form-group {{ $errors->has('nama_ibu') ? 'has-error' : '' }}">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <input required type="text" name="nama_ibu" class="form-control"
                                            id="nama_ibu" placeholder="Nama Ibu" />
                                        @error('nama_ibu')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-action mt-4">
                                    <button type="submit" class="btn btn-success">Simpat</button>
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
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        $(document).ready(function() {
            $('#status_perkawinan').on('change', function() {
                var statusPerkawinan = $(this).val();
                var noAktaNikah = $('#no_akta_nikah');
                var noAktaCerai = $('#no_akta_cerai');
                var tanggalNikah = $('#tanggal_nikah');
                var tanggalCerai = $('#tanggal_cerai');

                if (statusPerkawinan === 'menikah') {
                    noAktaNikah.prop('required', true).prop('disabled', false);
                    tanggalNikah.prop('required', true).prop('disabled', false);
                    noAktaCerai.prop('disabled', true).val('');
                    tanggalCerai.prop('disabled', true).val('');
                } else if (statusPerkawinan === 'duda' || statusPerkawinan === 'janda') {
                    noAktaCerai.prop('required', true).prop('disabled', false);
                    tanggalCerai.prop('required', true).prop('disabled', false);
                    noAktaNikah.prop('disabled', true).val('');
                    tanggalNikah.prop('disabled', true).val('');
                } else {
                    noAktaNikah.prop('disabled', true).val('');
                    tanggalNikah.prop('disabled', true).val('');
                    noAktaCerai.prop('disabled', true).val('');
                    tanggalCerai.prop('disabled', true).val('');
                }
            });
        });
    </script>
@endpush
