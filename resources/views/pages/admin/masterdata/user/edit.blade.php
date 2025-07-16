@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edir User</h3>
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
                        <a href="{{ route('user.index') }}">user</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form User</div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" class="row"
                                action="{{ route('user.update', Crypt::encrypt($user->id)) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">Nama Lengkap</label>
                                        <input value="{{ $user->name }}" required type="text" name="name"
                                            class="form-control" id="name" placeholder="Nama Pemohon" />
                                        @error('name')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email">email</label>
                                        <input value="{{ $user->email }}" required type="email" name="email"
                                            class="form-control" id="email" placeholder="email" />
                                        @error('email')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password">password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="password" />
                                        @error('password')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('nomor_ktp') ? 'has-error' : '' }}">
                                        <label for="nomor_ktp">Nomor_KTP</label>
                                        <input required value="{{ $user->nomor_ktp }}" type="text" name="nomor_ktp"
                                            class="form-control" id="nomor_ktp" placeholder="nomor_ktp Pemohon" />
                                        @error('nomor_ktp')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label for="phone">Nomor Telephone</label>
                                        <input required value="{{ $user->phone }}" type="text" name="phone"
                                            class="form-control" id="phone" placeholder="phone Pemohon" />
                                        @error('penghasilan')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                                        <label for="role">Role</label>
                                        <select name="role" class="form-select" id="formGroupDefaultSelect">
                                            <option value="admin">Admin</option>
                                            <option value="user">Masyarakat</option>
                                            <option value="lurah">Lurah</option>
                                        </select>
                                        @error('role')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                        <label for="avatar">Photo</label>
                                        <input type="file" name="avatar" class="form-control" id="avatar"
                                            placeholder="avatar" />
                                        @error('avatar')
                                            <small style="color: red" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                        <img src="{{ asset('storage/' . $user->avatar) }}" style="width: 100px"
                                            class="mt-2" alt="">
                                    </div>
                                    <div class="form-group {{ $errors->has('Alamat') ? 'has-error' : '' }}">
                                        <label for="Alamat">Alamat</label>
                                        <textarea value="{{ $user->alamat }}" name="alamat" class="form-control" id="comment" rows="5">
                                            {{ old('alamat', $user->alamat) }}
                                        </textarea>
                                        @error('alamat')
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
