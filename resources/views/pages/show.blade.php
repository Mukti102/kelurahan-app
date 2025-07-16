@extends('layouts.home')
@section('title', $berita->title)
@section('content')
    <div style="background: #000957;">
        <div class="container pb-5">
            <nav style="border-bottom: 0.8px solid white;" class="py-3 pt-4 ">
                <div class="nav__logo"><a href="#">SiAna</a></div>
                <ul class="nav__links" id="nav-links">
                    <li class="link"><a href="/">Beranda</a></li>
                    <li class="link"><a href="/login">Login</a></li>

                </ul>

                <div class="nav__menu__btn" id="menu-btn">
                    <span><i class="ri-menu-line"></i></span>
                </div>
            </nav>
            <div class="row mt-5 ">
                <!-- Main Content -->
                <div class="container-news  col-lg-8">
                    <div class="mb-3">
                        <h1 class="section__header text-3xl   font-bold text-gray-900 leading-tight">
                            {{ $berita->title }}
                        </h1>
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset('images/' . $berita->image) }}" alt="Thumbnail"
                            class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                    </div>
                    <div>
                        {!! $berita->content !!}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Berita Terbaru -->
                    <div class="mb-5 mt-4">
                        <h2 class="section__subheader text-xl font-semibold text-gray-900 mb-4">Berita Lainya</h2>
                        <ul class="list-unstyled">
                            @foreach ($beritas as $item)
                                <li class="mb-4 pb-2" style="border-bottom: 0.7px solid white">
                                    <a style="color: white" href="#" class="d-block text-gray-800 font-medium">
                                        {{ $item->title }}
                                    </a>
                                    <p style="color: rgb(212, 212, 212);font-size: 0.8rem;" class="text-sm mb-0 mt-1">
                                        {{ \Carbon\Carbon::parse($item->create_at)->format('d F Y') }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
