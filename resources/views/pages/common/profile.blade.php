@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="page-inner d-flex justify-content-center" style="height: 100vh;">
            <div class="card w-100" style="max-width: 800px;">
                <div class="card-body">
                    <div class="row">
                        <!-- Sidebar with Profile Info -->
                        <div class="col-0 col-md-4">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd"
                                id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                                <div class="text-center mb-4">
                                    <!-- Avatar -->
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle"
                                        style="width: 100px; height: 100px; object-fit: cover;" alt="User Avatar">
                                    <p class="mt-2 fw-bold">{{ $user->name }}</p>
                                    <span style="text-transform: capitalize"
                                        class="badge badge-success px-4 capitalize">{{ $user->role }}</span>
                                </div>
                                <!-- Navigation Links -->
                                <a class="nav-link active" id="v-pills-home-tab-nobd" data-bs-toggle="pill"
                                    href="#v-pills-home-nobd" role="tab" aria-controls="v-pills-home-nobd"
                                    aria-selected="true">Home</a>
                                <a class="nav-link" id="v-pills-profile-tab-nobd" data-bs-toggle="pill"
                                    href="#v-pills-profile-nobd" role="tab" aria-controls="v-pills-profile-nobd"
                                    aria-selected="false">Profile</a>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="col-0 col-md-8">
                            <div class="tab-content" id="v-pills-without-border-tabContent">
                                <!-- Home Tab -->
                                <div class="tab-pane fade show active" id="v-pills-home-nobd" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab-nobd">
                                    {{-- Profile Tab --}}
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Informasi Profil</h5>
                                            <p><strong>Nama: &nbsp;</strong> {{ Auth::user()->name }}</p>
                                            <p><strong>Email: &nbsp;</strong> {{ Auth::user()->email }}</p>
                                            <p><strong>No KTP: &nbsp;</strong> {{ Auth::user()->nomor_ktp }}</p>
                                            <p><strong>Nomor Telepon: &nbsp;</strong>
                                                {{ Auth::user()->phone ?? 'Belum diisi' }}
                                            </p>
                                            <p><strong>Alamat: &nbsp;</strong> {{ Auth::user()->alamat ?? 'Belum diisi' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Tab -->
                                <div class="tab-pane fade" id="v-pills-profile-nobd" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab-nobd">
                                    <form enctype="multipart/form-data" class="row"
                                        action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap</label>
                                                <input value="{{ $user->name }}" type="text" name="name"
                                                    class="form-control" id="name" placeholder="Nama Lengkap"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="no_ktp">Nomor KTP</label>
                                                <input value="{{ $user->nomor_ktp }}" type="text" name="nomor_ktp"
                                                    class="form-control" id="nomor_ktp" placeholder="Nomor KTP"
                                                    value="{{ old('nomor_ktp') }}">
                                                @error('nomor_ktp')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Nomor Telepon</label>
                                                <input value="{{ $user->phone }}" type="text" name="phone"
                                                    class="form-control" id="phone" placeholder="Nomor Telepon"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea cols="10" rows="5" name="alamat" class="form-control" id="alamat" placeholder="Alamat">{{ $user->alamat }}</textarea>
                                                @error('alamat')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input value="{{ $user->email }}" type="email" name="email"
                                                    class="form-control" id="email" placeholder="example@gmail.com"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="********">
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="avatar">Photo Profile</label>
                                                <input type="file" name="avatar" class="form-control" id="avatar"
                                                    placeholder="Nomor Telepon" value="{{ old('avatar') }}">
                                                @error('alamat')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-4 text-end">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
