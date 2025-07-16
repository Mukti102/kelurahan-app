@extends('layouts.main')

@section('title', 'Pengaturan')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Pengaturan </h3>
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
                        <a href="{{ route('pengaturan.index') }}">Pengaturan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Pengaturan</div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="row"
                                action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title">Nama</label>
                                        <input value="{{ old('title', $pengaturan->title) }}" type="text" name="title"
                                            class="form-control" id="title" placeholder="Nama">
                                        @error('title')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nama_lurah') ? 'has-error' : '' }}">
                                        <label for="nama_lurah">Nama Lurah</label>
                                        <input value="{{ old('nama_lurah', $pengaturan->nama_lurah) }}" type="text"
                                            class="form-control" id="nama_lurah" name="nama_lurah" placeholder="Nama Lurah">
                                        @error('nama_lurah')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nip_lurah') ? 'has-error' : '' }}">
                                        <label for="nip_lurah">Nip Lurah</label>
                                        <input value="{{ old('nip_lurah', $pengaturan->nip_lurah) }}" type="text"
                                            class="form-control" id="nip_lurah" name="nip_lurah" placeholder="Nip Lurah">
                                        @error('nip_lurah')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('provinsi') ? 'has-error' : '' }}">
                                        <label for="provinsi">Provinsi</label>
                                        <input value="{{ old('provinsi', $pengaturan->provinsi) }}" type="text"
                                            class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi">
                                        @error('provinsi')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group {{ $errors->has('kabupaten') ? 'has-error' : '' }}">
                                        <label for="kabupaten">kabupaten</label>
                                        <input value="{{ old('kabupaten', $pengaturan->kabupaten) }}" type="text"
                                            class="form-control" id="kabupaten" name="kabupaten" placeholder="Kabupaten">
                                        @error('kabupaten')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group {{ $errors->has('kecamatan') ? 'has-error' : '' }}">
                                        <label for="kecamatan">kecamatan</label>
                                        <input value="{{ old('kecamatan', $pengaturan->kecamatan) }}" type="text"
                                            class="form-control" id="kecamatan" name="kecamatan" placeholder="kecamatan">
                                        @error('kecamatan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- kelurahan --}}

                                    <div class="form-group {{ $errors->has('kelurahan') ? 'has-error' : '' }}">
                                        <label for="kelurahan">kelurahan</label>
                                        <input value="{{ old('kelurahan', $pengaturan->kelurahan) }}" type="text"
                                            class="form-control" id="kelurahan" name="kelurahan" placeholder="kelurahan">
                                        @error('kelurahan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group {{ $errors->has('desa') ? 'has-error' : '' }}">
                                        <label for="desa">desa</label>
                                        <input value="{{ old('desa', $pengaturan->desa) }}" type="text"
                                            class="form-control" id="desa" name="desa" placeholder="desa">
                                        @error('desa')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('kode_kelurahan') ? 'has-error' : '' }}">
                                        <label for="kode_kelurahan">kode_kelurahan</label>
                                        <input value="{{ old('kode_kelurahan', $pengaturan->kode_kelurahan) }}"
                                            type="text" class="form-control" id="kode_kelurahan"
                                            name="kode_kelurahan" placeholder="kode_kelurahan">
                                        @error('kode_kelurahan')
                                            <small style="color: red"
                                                class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- Alamat --}}
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                        <label for="alamat">Alamat</label>
                                        <textarea rows="5" class="form-control" id="alamat" name="alamat" placeholder="Alamat">{{ old('alamat', $pengaturan->alamat) }}</textarea>
                                        @error('alamat')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Tentang --}}
                                    <div class="form-group {{ $errors->has('tentang') ? 'has-error' : '' }}">
                                        <label for="tentang">Tentang</label>
                                        <textarea rows="5" class="form-control" id="tentang" name="tentang" placeholder="Tentang">{{ old('tentang', $pengaturan->tentang) }}</textarea>
                                        @error('tentang')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Logo --}}
                                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">

                                        <label for="logo">Logo</label>
                                        <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo">
                                        @error('logo')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                        <div style="margin-top: 10px">
                                            @if ($pengaturan->logo && Storage::disk('public')->exists($pengaturan->logo))
                                                <img width="100" height="60" style="object-fit: contain" src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Hero Background --}}
                                    <div class="form-group {{ $errors->has('hero_background') ? 'has-error' : '' }}">
                                        <label for="hero_background">Hero Background</label>
                                        <input type="file" class="form-control" id="hero_background" name="hero_background" placeholder="Hero Background">
                                        @error('hero_background')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                        <div style="margin-top: 10px">
                                            @if ($pengaturan->hero_background && Storage::disk('public')->exists($pengaturan->hero_background))
                                                <img width="100" height="60" style="object-fit: cover" src="{{ asset('storage/' . $pengaturan->hero_background) }}" alt="Hero Background">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tanda Tangan --}}
                                    <div class="form-group {{ $errors->has('tanda_tangan') ? 'has-error' : '' }}">
                                        <label for="tanda_tangan">Tanda Tangan Lurah</label>
                                        <input type="file" class="form-control" id="tanda_tangan" name="tanda_tangan" placeholder="Tanda Tangan">
                                        @error('tanda_tangan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                        <div style="margin-top: 10px">
                                            @if ($pengaturan->tanda_tangan && Storage::disk('public')->exists($pengaturan->tanda_tangan))
                                                <img width="100" height="60" style="object-fit: contain" src="{{ asset('storage/' . $pengaturan->tanda_tangan) }}" alt="Tanda Tangan">
                                            @endif
                                        </div>
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
