<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>@yield('title') - Kantor Kelurahan Sorkam Kanan</title>
</head>

<body>
    @yield('content')
    <footer class="footer bg-dark text-light py-4">
        <div class="container text-center">
            <h5><a href="#" class="text-light">Kelurahan Sorkam Kanan</a></h5>
            <p>
                Melayani masyarakat dengan transparansi dan profesionalisme untuk kesejahteraan bersama.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="text-light"><i class="ri-facebook-fill"></i></a>
                <a href="#" class="text-light"><i class="ri-twitter-fill"></i></a>
                <a href="#" class="text-light"><i class="ri-instagram-line"></i></a>
                <a href="#" class="text-light"><i class="ri-linkedin-fill"></i></a>
            </div>
            <hr class="bg-light my-3">
            <p class="mb-0">Hak Cipta &copy; 2024 Kantor Kelurahan Sorkam Kanan. Seluruh Hak Dilindungi.</p>
        </div>
    </footer>

    <div style="position: fixed; bottom: 25px; right: 20px; z-index: 1000; background: white; border-radius: 50%;">
        <a href="https://wa.me/{{ $pengaturan->whatsapp }}" target="_blank" style="text-decoration: none;">
            <img src="https://tse3.mm.bing.net/th?id=OIP.qeBL7LoMSOxJnY_hd_ZOZgHaHc&pid=Api&P=0&h=180" 
                alt="WhatsApp" 
                style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>

</html>