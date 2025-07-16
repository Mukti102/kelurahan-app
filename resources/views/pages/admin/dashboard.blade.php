@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Selamat Datang {{ Auth::user()->name }} 😊</h6>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('surat-keterangan-meninggal-dunia.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat Kematian</p>
                                    <h4 class="card-title">{{ $suratsKematian->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('surat-keterangan-miskin.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat Ktrgn Miskin</p>
                                    <h4 class="card-title">{{ $suratsMiskin->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('surat-pengantar-nikah.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat Nikah</p>
                                    <h4 class="card-title">{{ $suratsNikah->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('surat-keterangan-penghasilan.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat Penghasilan</p>
                                    <h4 class="card-title">{{ $suratsPenghasilan->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('surat-pengantar-skck.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat SKCK</p>
                                    <h4 class="card-title">{{ $suratsSKCK->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('surat-pernyataan-penguasaan-tanah.index') }}" class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ajuan Surat Tanah</p>
                                    <h4 class="card-title">{{ $suratsTanah->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <x-surat-statistik />
    </div>
@endsection
@push('script')
    <script>
        var ctx = document.getElementById('statisticsChart1').getContext('2d');

        var statisticsChart1 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: "Surat Keterangan Meninggal Dunia",
                    borderColor: '#f3545d',
                    pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(243, 84, 93, 0.4)',
                    legendColor: '#f3545d',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsKematians) }}
                }, {
                    label: "Surat Keterangan Tidak Mampu (Miskin)",
                    borderColor: '#fdaf4b',
                    pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(253, 175, 75, 0.4)',
                    legendColor: '#fdaf4b',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsMiskins) }}
                }, {
                    label: "Surat Keterangan Penghasilan Orang Tua",
                    borderColor: '#177dff',
                    pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(23, 125, 255, 0.4)',
                    legendColor: '#177dff',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsPenghasilans) }}
                }, {
                    label: "Surat Pengantar SKCK",
                    borderColor: '#30E414',
                    pointBackgroundColor: 'rgba(48, 228, 10, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(48, 228, 10, 0.4)',
                    legendColor: '#30E414',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsSKCKs) }}
                }, {
                    label: "Surat Keterangan Tanah",
                    borderColor: '#6E14E4',
                    pointBackgroundColor: 'rgba(110, 20, 228, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(110, 20, 228, 0.4)',
                    legendColor: '#6E14E4',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsTanahs) }}
                }, {
                    label: "Surat Pengantar Nikah",
                    borderColor: '#E51BB6',
                    pointBackgroundColor: 'rgba(229, 27, 182, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(229, 27, 182, 0.4)',
                    legendColor: '#E51BB6',
                    fill: true,
                    borderWidth: 2,
                    data: {{ json_encode($suratsNikahs) }}
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor +
                            '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });

        var myLegendContainer = document.getElementById("myChartLegend");

        // generate HTML legend
        myLegendContainer.innerHTML = statisticsChart1.generateLegend();
    </script>
@endpush
