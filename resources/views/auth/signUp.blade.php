<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Register</title>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ 'storage/' . $pengaturan->logo }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            {{ $pengaturan->title }}
        </div>
        <form class="p-3 mt-3" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <!-- Name Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="far fa-user"></span>
                        <input type="text" name="name" id="name" placeholder="Name"
                            value="{{ old('name') }}">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="far fa-envelope"></span>
                        <input type="email" name="email" id="email" placeholder="Email"
                            value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <div class="row">
                <!-- gender -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="far fa-user"></span>
                        <select name="gender" id="gender">
                            <option selected disabled value="">Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <!-- nomor ktp Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="fas fa-users"></span>
                        <input type="text" name="nomor_ktp" id="nomor_ktp" placeholder="Nomor KTP"
                            value="{{ old('nomor_ktp') }}">
                    </div>
                    <x-input-error :messages="$errors->get('nomor_ktp')" class="mt-2" />
                </div>
                <div class="col-md-6">
                    <!-- nomor hp hp Field -->
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="fas fa-phone"></span>
                        <input type="text" name="phone" id="phone" placeholder="Nomor Phone"
                            value="{{ old('phone') }}">
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>


                <!-- alamat  Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="fas fa-home"></span>
                        <input type="text" name="alamat" id="alamat" placeholder="Alamat"
                            value="{{ old('alamat') }}">
                    </div>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="fas fa-key"></span>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password Field -->
                <div class="col-md-6">
                    <div class="form-field d-flex align-items-center px-3">
                        <span class="fas fa-lock"></span>
                        <input type="password" name="password_confirmation" autocomplete="new-password"
                            id="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <button class="btn mt-3">Register</button>
        </form>
        <div class="text-center fs-6">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
</body>

</html>
