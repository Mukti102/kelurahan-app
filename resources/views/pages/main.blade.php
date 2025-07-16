@extends('layouts.home')
@section('title', 'Home')
@section('content')
    <header
        style="background-image: linear-gradient(to right,
        rgba(0, 0, 0, 0.5),
        rgba(0, 0, 0, 0.8)),
    url('{{ asset('storage/' . $pengaturan->hero_background) }}')">
        <nav>
            <div class="nav__logo">
                <div>
                    <img width="100" src="{{ asset('storage/' . $pengaturan->logo) }}" alt="">
                </div>
                <div>
                    <a href="#">{{ $pengaturan->title }}</a>
                    <h3 class="kabupaten-name">Kabupaten {{ $pengaturan->kabupaten }}</h3>
                </div>
            </div>
            <div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li class="link"><a href="#home">Beranda</a></li>
                <li class="link"><a href="#about">Profil</a></li>
                <li class="link"><a href="#subscribe">Sejarah</a></li>
                <li class="link"><a href="#visimisi">Visi Misi</a></li>
                <li class="link"><a href="#blog">Berita</a></li>
                <li class="link"><a
                        href="{{ Auth::check() ? route('logout') : route('login') }}">{{ Auth::check() ? 'Logout' : 'Login' }}</a>
                </li>

            </ul>

            <div class="nav__menu__btn" id="menu-btn">
                <span><i class="ri-menu-line"></i></span>
            </div>
        </nav>
        <div class="section__container header__container" data-aos="zoom-in" id="home">
            <h1>Selamat Datang, Web Pengajuan Surat </h1>
        </div>
    </header>

    <section class="about" id="about">
        <div class="section__container about__container">
            <div class="about__grid">
                <div class="about__content">
                    <p class="section__subheader">Profil</p>
                    <h2 class="section__header">{{ $pengaturan->title }}</h2>
                    <p class="section__text">
                        {{ $pengaturan->tentang }}
                    </p>
                    <br />
                    {{ $pengaturan->alamat }}
                    </p>
                </div>
                <div class="about__list">
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Meninggal Dunia</h4>
                    </div>
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Keteranagn Miskin</h4>
                    </div>
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Keterangan Penghasilan</h4>
                    </div>
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Pengantar Nikah</h4>
                    </div>
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Pengantar SKCK</h4>
                    </div>
                    <div class="about__item">
                        <span><i class=""></i></span>
                        <h4>Pengajuan Surat Pernyataan Penguasaan Tanah</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="subscribe"
        style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.185), rgba(0, 0, 0, 0.8)), url({{ asset('storage/' . $pengaturan->hero_background) }}); background-attachment: fixed; background-size: cover; background-position: center;"
        id="subscribe">
        <div class="section__container subscribe__container" data-aos="fade-up">
            <p class="section__header">Sejarah {{ $pengaturan->title }}</p>
            <p class="para">
            Desa Sorkam Kanan, yang terletak di Kecamatan Sorkam Barat, Kabupaten Tapanuli Tengah, 
            memiliki sejarah yang kaya. Pada abad ke-14, wilayah Sorkam menjadi kawasan rantau dan koloni dagang Minangkabau, 
            berada di bawah pengaruh Kerajaan Pagaruyung. Pada tahun 1758, setelah konflik keluarga di Barus,
             Raja Junjungan gelar Datuk Bungkuk mendirikan Kesultanan Sorkam, yang memiliki kekerabatan dengan Kesultanan Barus. 
             Pada abad ke-19, migrasi masyarakat Batak Toba dan Mandailing menambah keragaman budaya di Sorkam. 
             Desa Sorkam Kanan juga dikenal sebagai lokasi Makam Islam Tua Raja-raja Sorkam, tempat peristirahatan para raja, 
             termasuk Datuk Badara Putih atau Raja Ahmad. citeturn0search0turn0search4 
            </p>
        </div>
    </section>

    <section class="visi-misi" id="visimisi">
        <div data-aos="fade-right" class="logo">
            <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="">
            <h2 style="margin-top: 20px;">Desa {{ $pengaturan->title }}</h2>
            <p>{{ $pengaturan->alamat }}</p>
        </div>
        <div class="misi" data-aos="fade-left">
            <h2>Visi</h2>
            <p>
                Menjadi pusat ilmu pengetahuan, teknologi, dan kebudayaan yang unggul dan berdaya saing,
                melalui upaya mencerdaskan kehidupan bangsa untuk meningkatkan kesejahteraan masyarakat,
                sehingga berkontribusi bagi pembangunan masyarakat Indonesia dan dunia.
            </p>
            <h2 style="margin-top:60px">Misi</h2>
            <ol style="text-align: left;">
                <li>Menyediakan akses yang luas dan adil, serta pendidikan dan pengajaran yang berkualitas.</li>
                <li>Menyelenggarakan kegiatan Tridharma yang bermutu dan relevan dengan tantangan nasional serta global.
                </li>
                <li>Menciptakan lulusan yang berintelektualitas tinggi, berbudi luhur dan mampu bersaing secara global.</li>
                <li>Menciptakan iklim akademik yang kondusif dan inovatif.</li>
            </ol>
        </div>
    </section>

    {{-- struktur oganisasi --}}
    <section class="" style="color: black">
        <div class="section__container struktur-organisasi__container">
            <h2 data-aos="fade-right" class="section__header">Struktur Organisasi</h2>
            <div data-aos="zoom-in" class="image-container">
                <img src="/images/struktur/struktur.png" alt="Struktur Organisasi" class="zoomable-image">
            </div>
        </div>
    </section>

    <!-- Modal untuk zoom -->
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>


    <section class="banner">
        <div class="section__container banner__container">
            <div class="banner__content" data-aos="fade-right">
                <p class="section__subheader">Tentang Kami</p>
                <h2 class="section__header">
                    Kantor Kelurahan Sorkam Kanan
                </h2>
                <p class="para">
                Kantor Kelurahan Sorkam Kanan, Kecamatan Sorkam Barat, 
                Kabupaten Tapanuli Tengah, berfungsi sebagai pusat administrasi dan pelayanan publik bagi masyarakat setempat. Kantor ini melayani administrasi kependudukan, pembangunan, serta kegiatan sosial kemasyarakatan.
                </p>
            </div>
        </div>
    </section>

    <section class="blog" id="blog">
        <div class="section__container blog__container" data-aos="fade-up">
            <p class="section__subheader">Memori {{ $pengaturan->title }}</p>
            <h2 class="section__header">Berita Terkini</h2>
            <div class="blog__grid">
                {{-- card berita --}}
                @foreach ($berita as $item)
                    <a href="{{ route('berita.show', Crypt::encrypt($item->id)) }}" class="blog__card">
                        <img src="{{ asset('images/' . $item->image) }}" alt="" />
                        <div>
                            <span><i class="ri-user-line"></i> By Admin</span>
                            <span><i class="ri-time-line"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>

                        </div>
                        <h4 style="color: white;">{{ $item->title }}</h4>
                        <p>
                            {{ Str::limit(strip_tags($item->content), 60, '...') }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="subscribe" style="color: black" id="subscribe">
        <div class="section__container subscribe__container">
            <p class="section__subheader">Info Lebih</p>
            <h2 class="section__header">
                Hubungi kita atau datang langsung ke Kantor Kelurahan Sorkam Kanan
            </h2>
            <p class="para">
            Alamat : Jl. Sibolga - Barus No.15, Sorkam Kanan, Kec. Sorkam Bar., 
            Kabupaten Tapanuli Tengah, Sumatera Utara 22563
                <br>
                Kontak: {{ $pengaturan->whatsapp }}
            </p>
        </div>
        <div>
            <figure>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5930229565806!2d98.58596399999999!3d1.9137062999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e51edeb535fbf%3A0x499b909a951ecda!2sKantor%20Kelurahan%20Sorkam%20Kanan!5e0!3m2!1sen!2sid!4v1739203270658!5m2!1sen!2sid"
                    width="1000" height="400" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </figure>
        </div>
    </section>

    <section class="customer">
        <div class="section__container customer__container">
            <p class="section__subheader">Kata Masyarakat</p>
            <h2 class="section__header">Apa Kata Masyarakat</h2>
            <p class="para">
                Temukan kesan dan cerita yang dibagikan oleh para alumni tentang pengalaman istimewa mereka
                selama menempuh pendidikan di SMKS St. Nahanson Parapat. Mereka berbagi bagaimana sekolah ini
                telah memberi fondasi yang kuat dan inspirasi bagi perjalanan karir mereka.
            </p>
            <div class="customer__review">
                <!-- Slider main container -->
                <div class="swiper swiper-autoplay">
                    <div class="swiper-wrapper">
                        @foreach ($testimoni as $item)
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <div class="customer__review__card">
                                    <span><i class="ri-double-quotes-r"></i></span>
                                    <p>
                                        {{ $item->content }}
                                    </p>
                                    <div class="customer__review__details">
                                        <img style="border-radius: 50%; width: 50px; height: 45px; object-fit: cover;"
                                            src="{{ asset('storage/' . $item->avatar) }}" alt="Avatar" />

                                        <div>
                                            <h4>{{ $item->nama }}</h4>
                                            <h5>{{ $item->jabatan }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            const zoomableImage = document.querySelector(".zoomable-image");
            const closeBtn = document.querySelector(".close");

            zoomableImage.addEventListener("click", function() {
                modal.style.display = "flex";
                modalImg.src = this.src;
            });

            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            modal.addEventListener("click", function(e) {
                if (e.target !== modalImg) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
@endsection
