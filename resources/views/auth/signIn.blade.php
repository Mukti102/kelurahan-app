<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/signin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ 'storage/' . $pengaturan->logo }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            {{ $pengaturan->title }}
        </div>
        <form class="p-3 mt-3" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-field d-flex align-items-center px-3">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <div class="form-field d-flex align-items-center px-3">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <button class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="{{ route('password.request') }}">Forget password?</a> or <a href="{{ route('register') }}">Sign
                up</a>
        </div>
    </div>
</body>

</html>
