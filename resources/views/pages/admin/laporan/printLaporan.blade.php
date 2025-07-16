<!DOCTYPE html>
<html>

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<head>
    <style>
        .pdf-container {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .alamat {
            font-size: 12px;
            font-style: italic;
            margin-bottom: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
            text-align: center;
        }

        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="pdf-container">
        <div class="header">
            <div class="kop-surat" style="text-transform: uppercase">KANTOR DESA {{ $pengaturan->desa }} KECAMATAN
                {{ $pengaturan->kecamatan }}</div>
            <div class="kop-surat" style="text-transform: uppercase">KOTA {{ $pengaturan->kabupaten }}</div>
            <div class="alamat">
                {{ $pengaturan->alamat }}, Kode Pos {{ $pengaturan->kode_pos }} | 
            </div>

        </div>

        <table class="table " >
            <thead>
                <tr>
                    <th style="width: 30px;">No.</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Nomor Surat</th>
                    <th>Nomor KTP</th>
                    <th>Nama</th>
                    <th>Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surats as $surat)
                    @php
                        $letterShortName;
                        $letterType;
                        if ($surat->letterable_type == 'App\Models\LetterMiskin') {
                            $letterShortName = 'SKM';
                            $letterType = 'Surat Keterangan Tidak Mampu';
                        } elseif ($surat->letterable_type == 'App\Models\LetterMeninggal') {
                            $letterShortName = 'SKMD';
                            $letterType = 'Surat Keterangan Meninggal Dunia';
                        } elseif ($surat->letterable_type == 'App\Models\LetterPenghasilan') {
                            $letterShortName = 'SKP-OT';
                            $letterType = 'Surat Keterangan Penghasilan Orang Tua';
                        } elseif ($surat->letterable_type == 'App\Models\LetterSKCK') {
                            $letterShortName = 'SPKCK';
                            $letterType = 'Surat Pengantar SKCK';
                        } elseif ($surat->letterable_type == 'App\Models\LetterNikah') {
                            $letterShortName = 'SPN';
                            $letterType = 'Surat Pengantar Nikah';
                        } else {
                            $letterShortName = 'SKT';
                            $letterType = 'Surat Keterangan Tanah';
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-nowrap">
                            {{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('l, d F Y') }}
                        </td>

                        <td>
                            {{ str_pad($surat->letterable_id, 3, '0', STR_PAD_LEFT) }}/{{ $letterShortName }}/2001/{{ \Carbon\Carbon::now()->format('Y') }}
                        </td>
                        <td>{{ $surat->user->nomor_ktp }}</td>
                        <td>{{ $surat->user->name }}</td>
                        <td>{{ $letterType }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


            <div
                style="position:absolute;right: 10px; auto; font-size: 13px; text-align: center; display: flex; flex-direction: column; align-items: flex-end; margin-left: auto;margin-top: 2%">
                <div>
                    <p style="margin: 0;">Dikeluarkan di: Kelurahan {{ $pengaturan->kelurahan }}</p>
                    <p style="margin: 0;">Pada Tanggal: <strong>{{ \Carbon\Carbon::now()->format('d M Y') }}</strong></p>
                </div>
                <div>
                    @php
                        $data = file_get_contents('storage/' . $pengaturan->tanda_tangan);
                        $type = pathinfo('storage/' . $pengaturan->tanda_tangan, PATHINFO_EXTENSION);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    @endphp
                    <img width="160" style="object-fit: cover" src="{{ $base64 }}">
                </div>
                <div style="font-size: 13px;">
                    <p
                        style="margin: 0; font-weight: bold; text-transform: uppercase; border-bottom: 1.5px solid; display: inline-block;">
                        Lurah
                        {{ $pengaturan->nama_lurah }}
                    </p>
                    <p style="margin: 0; font-weight: bold;text-transform: uppercase">NIP:
                        {{ $pengaturan->nip_lurah }}</p>
                </div>
            </div>   
    </div>
</body>

</html>
