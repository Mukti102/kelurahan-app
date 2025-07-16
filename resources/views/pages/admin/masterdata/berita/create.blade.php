@extends('layouts.main')

@section('title', 'Tambah Berita')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tambah Berita</h3>
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
                        <a href="{{ route('berita.index') }}">Beritas</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Berita</div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="row" action="{{ route('berita.store') }}"
                                method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                        <label for="title">Judul</label>
                                        <input required type="text" name="title" value="{{ old('title') }}"
                                            class="form-control" id="title" placeholder="Nama Pemohon" />
                                        @error('title')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                        <label for="image">Thumbnail</label>
                                        <input required type="file" name="image" value="{{ old('image') }}"
                                            class="form-control" id="image" placeholder="image" />
                                        @error('image')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <label for="content">Konten</label>
                                    <textarea required name="content" class="form-control" id="content" placeholder="Tulis konten di sini">
                                        {{ old('content') }}
                                    </textarea>
                                    @error('content')
                                        <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                    @enderror
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
