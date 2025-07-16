@php
    $routeCurrent =
        Route::current()->getName() == 'suratMeninggal.selesai' ||
        Route::current()->getName() == 'surat-keterangan-miskin.selesai' ||
        Route::current()->getName() == 'surat-pengantar-skck.selesai' ||
        Route::current()->getName() == 'surat-penghasilan.selesai' ||
        Route::current()->getName() == 'surat-pengantar-nikah.selesai' ||
        Route::current()->getName() == 'surat-pernyataan-penguasaan-tanah.selesai';
        
@endphp
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="navbar brand" class="navbar-brand"
                    width="50" alt="{{ asset('storage/' . $pengaturan->logo) }}" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li
                    class="nav-item {{ Route::current()->getName() == 'masyarakat.dashboard' || Route::current()->getName() == 'lurah.dashboard' || Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                    @php
                        $route;
                        $user = Auth::user();
                        if ($user->role == 'admin') {
                            $route = 'admin.dashboard';
                        } elseif ($user->role == 'lurah') {
                            $route = 'lurah.dashboard';
                        } else {
                            $route = 'masyarakat.dashboard';
                        }
                    @endphp
                    <a href="{{ route($route) }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Data Penduduk</h4>
                    </li>
                    <li class="nav-item {{ Route::current()->getName() == 'penduduk.index' ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#penduduk">
                            <i class="fas fa-layer-group"></i>
                            <p>Data Penduduk</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ Route::current()->getName() == 'penduduk.index' ? 'show' : '' }}"
                            id="penduduk">
                            <ul class="nav nav-collapse">
                                <li class="{{ Route::current()->getName() == 'penduduk.index' ? 'active' : '' }}">
                                    <a href="{{ route('penduduk.index') }}">
                                        <span class="sub-item">Penduduk</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Master Data</h4>
                    </li>
                    <li
                        class="nav-item {{ Route::current()->getName() == 'user.index' || Route::current()->getName() == 'berita.index' ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#masterdata">
                            <i class="fas fa-layer-group"></i>
                            <p>Master Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ Route::current()->getName() == 'user.index' || Route::current()->getName() == 'berita.index' || Route::current()->getName() == 'testimoni.index' ? 'show' : '' }}"
                            id="masterdata">
                            <ul class="nav nav-collapse">
                                <li class="{{ Route::current()->getName() == 'user.index' ? 'active' : '' }}">
                                    <a href="{{ route('user.index') }}">
                                        <span class="sub-item">Users</span>
                                    </a>
                                </li>
                                <li class="{{ Route::current()->getName() == 'berita.index' ? 'active' : '' }}">
                                    <a href="{{ route('berita.index') }}">
                                        <span class="sub-item">Berita</span>
                                    </a>
                                </li>

                                <li class="{{ Route::current()->getName() == 'testimoni.index' ? 'active' : '' }}">
                                    <a href="{{ route('testimoni.index') }}">
                                        <span class="sub-item">Testimoni Masyarakat</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Pengajuan Surat</h4>
                    </li>
                    <li
                        class="nav-item {{ Route::current()->getName() == 'surat-masuk.index' || Route::current()->getName() == 'surat-selesai.index' ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#suratMasuk">
                            <i class="fas fa-th-list"></i>
                            <p>Surat Masuk</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ Route::current()->getName() == 'surat-masuk.index' || Route::current()->getName() == 'surat-selesai.index' ? 'show' : '' }}"
                            id="suratMasuk">
                            <ul class="nav nav-collapse">
                                <li class="{{ Route::current()->getName() == 'surat-masuk.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-masuk.index') }}">
                                        <span class="sub-item">Surat Masuk</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li class="nav-item {{ $routeCurrent ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#suratSelesai">
                            <i class="fas fa-check-circle"></i>
                            <p>Surat Selesai</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $routeCurrent ? 'show' : '' }}" id="suratSelesai">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ Route::current()->getName() == 'suratMeninggal.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('suratMeninggal.selesai') }}">
                                        <span class="sub-item">Surat Meninggal Dunia</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-miskin.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-miskin.selesai') }}">
                                        <span class="sub-item">Surat Keteranagn Miskin</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-skck.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-skck.selesai') }}">
                                        <span class="sub-item">Surat Pengantar SKCK</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-penghasilan.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-penghasilan.selesai') }}">
                                        <span class="sub-item">Surat Keteranagn Penghasilan</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-nikah.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-nikah.selesai') }}">
                                        <span class="sub-item">Surat Pengantar Nikah</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pernyataan-penguasaan-tanah.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pernyataan-penguasaan-tanah.selesai') }}">
                                        <span class="sub-item">Surat Pernyataan Penguasaan Tanah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ Route::current()->getName() == 'laporan.index' ? 'active' : '' }}">
                        <a href="{{ route('laporan.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'lurah')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Pengajuan Surat</h4>
                    </li>
                    <li
                        class="nav-item {{ Route::current()->getName() == 'surat-masuk.index' || Route::current()->getName() == 'surat-selesai.index' ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Belum Acc</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ Route::current()->getName() == 'surat-masuk.index' ? 'show' : '' }}"
                            id="base">
                            <ul class="nav nav-collapse">
                                <li class="{{ Route::current()->getName() == 'surat-masuk.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-masuk.index') }}">
                                        <span class="sub-item">Surat Masuk</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </li>

                    <li class="nav-item {{ $routeCurrent ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#suratSelesai">
                            <i class="fas fa-th-list"></i>
                            <p>Surat Selesai</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $routeCurrent ? 'show' : '' }}" id="suratSelesai">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ Route::current()->getName() == 'suratMeninggal.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('suratMeninggal.selesai') }}">
                                        <span class="sub-item">Surat Meninggal Dunia</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-miskin.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-miskin.selesai') }}">
                                        <span class="sub-item">Surat Keteranagn Miskin</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-skck.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-skck.selesai') }}">
                                        <span class="sub-item">Surat Pengantar SKCK</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-penghasilan.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-penghasilan.selesai') }}">
                                        <span class="sub-item">Surat Keteranagn Penghasilan</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-nikah.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-nikah.selesai') }}">
                                        <span class="sub-item">Surat Pengantar Nikah</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pernyataan-penguasaan-tanah.selesai' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pernyataan-penguasaan-tanah.selesai') }}">
                                        <span class="sub-item">Surat Pernyataan Penguasaan Tanah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li class="nav-item {{ Route::current()->getName() == 'laporan.index' ? 'active' : '' }}">
                        <a href="{{ route('laporan.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'user')
                @php
                        $currentRoute = Route::current()->getName();
                    
                        $routeCurrent = in_array($currentRoute, [
                            'surat-keterangan-meninggal-dunia.index',
                            'surat-keterangan-miskin.index',
                            'surat-pengantar-skck.index',
                            'surat-keterangan-penghasilan.index',
                            'surat-pengantar-nikah.index',
                            'surat-pernyataan-penguasaan-tanah.index',
                        ]);
                    
                        $routeCreate = in_array($currentRoute, [
                            'surat-keterangan-meninggal-dunia.create',
                            'surat-keterangan-miskin.create',
                            'surat-pengantar-skck.create',
                            'surat-keterangan-penghasilan.create',
                            'surat-pengantar-nikah.create',
                            'surat-pernyataan-penguasaan-tanah.create',
                        ]);
                    @endphp
            
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Pengajuan Saya</h4>
                    </li>
                    <li class="nav-item {{ $routeCreate ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#createpengajuan">
                            <i class="fa fa-ellipsis-h"></i>
                            <p>Pengajuan Surat</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $routeCreate ? 'show' : '' }}" id="createpengajuan">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-meninggal-dunia.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-meninggal-dunia.create') }}">
                                        <span class="sub-item">Surat Keterangann Meninggal Dunia</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-miskin.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-miskin.create') }}">
                                        <span class="sub-item">Surat Keterangan Tidak Mampu</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-skck.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-skck.create') }}">
                                        <span class="sub-item">Surat Pengantar SKCK</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-penghasilan.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-penghasilan.create') }}">
                                        <span class="sub-item">Surat Keterangan Penghasilan</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-nikah.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-nikah.create') }}">
                                        <span class="sub-item">Surat Pengantar Nikah</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pernyataan-penguasaan-tanah.create' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pernyataan-penguasaan-tanah.create') }}">
                                        <span class="sub-item">Surat Pernyataan Penguasaan Tanah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item {{ $routeCurrent ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#datapengajuan">
                            <i class="far fa-chart-bar"></i>
                            <p>Notifikasi Surat</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $routeCurrent ? 'show' : '' }}" id="datapengajuan">
                            <ul class="nav nav-collapse">
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-meninggal-dunia.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-meninggal-dunia.index') }}">
                                        <span class="sub-item">Surat Keterangan Meninggal Dunia</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-miskin.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-miskin.index') }}">
                                        <span class="sub-item">Surat Keterangan Tidak Mampu</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-skck.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-skck.index') }}">
                                        <span class="sub-item">Surat Pengantar SKCK</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-keterangan-penghasilan.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-keterangan-penghasilan.index') }}">
                                        <span class="sub-item">Surat Keterangan Penghasilan</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pengantar-nikah.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pengantar-nikah.index') }}">
                                        <span class="sub-item">Surat Pengantar Nikah</span>
                                    </a>
                                </li>
                                <li
                                    class="{{ Route::current()->getName() == 'surat-pernyataan-penguasaan-tanah.index' ? 'active' : '' }}">
                                    <a href="{{ route('surat-pernyataan-penguasaan-tanah.index') }}">
                                        <span class="sub-item">Surat Pernyataan Penguasaan Tanah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Setting</h4>
                </li>
                <li
                    class="nav-item {{ Route::current()->getName() == 'pengaturan.index' || Route::current()->getName() == 'profile.edit' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sidebarSetting">
                        <i class="fas fa-wrench"></i>
                        <p>Setting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::current()->getName() == 'pengaturan.index' || Route::current()->getName() == 'profile.edit' ? 'show' : '' }}"
                        id="sidebarSetting">
                        <ul class="nav nav-collapse">
                            @if (Auth::user()->role == 'admin')
                                <li class="{{ Route::current()->getName() == 'pengaturan.index' ? 'active' : '' }}">
                                    <a href="{{ route('pengaturan.index') }}">
                                        <span class="sub-item">Setting</span>
                                    </a>
                                </li>
                            @endif
                            <li class="{{ Route::current()->getName() == 'profile.edit' ? 'active' : '' }}">
                                <a href="{{ route('profile.edit') }}">
                                    <span class="sub-item">Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
