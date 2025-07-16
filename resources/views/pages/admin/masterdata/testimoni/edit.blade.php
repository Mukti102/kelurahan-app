@extends('layouts.main')

@section('title', 'Edit Testimoni')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Testimoni</h3>
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
                        <a href="{{ route('testimoni.index') }}">Testimoni</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form testimoni</div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="row"
                                action="{{ route('testimoni.update', $testimoni->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-10">
                                    <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                                        <label for="nama">Nama</label>
                                        <input value="{{ $testimoni->nama }}" required type="text" name="nama"
                                            class="form-control" id="nama" placeholder="Nama Lengkap" />
                                        @error('nama')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                                        <label for="jabatan">Jabatan</label>
                                        <input required type="text" name="jabatan" value="{{ $testimoni->jabatan }}"
                                            class="form-control" id="jabatan" placeholder="jabatan" />
                                        @error('jabatan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('testimoni') ? 'has-error' : '' }}">
                                        <label for="testimoni">testimoni</label>
                                        <textarea cols="10" rows="5" required type="text" name="testimoni" value="{{ old('testimoni') }}"
                                            class="form-control" id="testimoni" placeholder="testimoni">
                                            {{ $testimoni->testimoni }}
                                        </textarea>
                                        @error('testimoni')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                        <label for="avatar">Photo Profile</label>
                                        <input required type="file" name="avatar" class="form-control" id="avatar"
                                            placeholder="avatar" />
                                        @error('avatar')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                        <img src="{{ asset('storage/' . $testimoni->avatar) }}" alt=""
                                            style="width: 100px" class="mt-2">
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
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endpush
