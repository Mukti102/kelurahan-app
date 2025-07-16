<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    @include('includes.styles')
</head>

<body>
    {{-- login  --}}

    <div class="page">
        <div class="page-single">
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <img src="/assets/img/kaiadmin/logo.svg" class="h-6" alt="sss" />
                        </div>
                        <form class="card card-md w-50 mx-auto mt-5" method="POST" action="">
                            @csrf
                            <div class="card-body">
                                <p class="text-muted">Sign in to your account</p>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter your password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
