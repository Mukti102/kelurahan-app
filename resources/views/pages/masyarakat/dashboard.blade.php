@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Pengajuan Surat</h3>
                <h6 class="op-7 mb-2">Selamat Datang {{ Auth::user()->name }} 😊</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <small class="text-secondary">Surat Keterangan Meninggal</small>
                                    <a href="{{ route('surat-keterangan-meninggal-dunia.create') }}"
                                        class="btn btn-xs mt-2 btn-info">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="text-secondary card-category">Surat Keterangan Miskin</p>
                                    <a href="{{ route('surat-keterangan-miskin.create') }}"
                                        class="btn btn-xs mt-2 btn-success">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="text-secondary card-category">Surat Pengantar SKCK</p>
                                    <a href="{{ route('surat-pengantar-skck.create') }}"
                                        class="btn btn-xs mt-2 btn-warning">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="text-secondary card-category ">Surat Penghasilan</p>
                                    <a href="{{ route('surat-keterangan-penghasilan.create') }}"
                                        class="btn btn-xs mt-2 btn-primary text-white">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="text-secondary card-category">Surat Pengantar Nikah</p>
                                    <a href="{{ route('surat-pengantar-nikah.create') }}"
                                        class="btn btn-xs mt-2 btn-danger text-white">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="
                                    fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="text-secondary card-category">Surat Penguasaan Tanah</p>
                                    <a href="{{ route('surat-pernyataan-penguasaan-tanah.create') }}"
                                        class="btn btn-xs mt-2 btn-secondary text-white">
                                        <span class="me-2">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        Buat Surat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
