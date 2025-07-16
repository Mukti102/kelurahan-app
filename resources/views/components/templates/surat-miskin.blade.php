<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SKTM/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>
    <p style="line-height: 1.5; text-align: justify;">
        Yang bertanda tangan di bawah ini, Lurah Sorkam Kanan, Kecamatan Sorkam Barat, Kabupaten Tapanuli Tengah,
        dengan ini menerangkan bahwa:
    </p>

    <table style="width: 90%;margin-left: 100px; border-collapse: collapse; margin-bottom: 20px;">
        <tbody style="text-transform: capitalize;">
            <tr>
                <td style="width: 30%; padding: 5px 0;">Nama</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->nama_pemohon }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">NIK</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->nik_pemohon }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Jenis Kelamin</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Tempat/Tanggal Lahir</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Agama</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->agama }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Pekerjaan</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Status</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->status_perkawinan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Kewarganegaraan</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->kewarganegaraan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Alamat Lengkap</td>
                <td style="padding: 5px 0;">: &nbsp;{{ $surat->alamat }}</td>
            </tr>
        </tbody>
    </table>

    <p style="line-height: 1.5; text-align: justify;">
        Nama di atas tersebut adalah benar penduduk Kelurahan Sorkam Kanan, Kecamatan Sorkam Barat, Kabupaten Tapanuli
        Tengah,
        selanjutnya diterangkan bahwa nama tersebut di atas benar keluarga tidak mampu dan memiliki rumah yang tidak
        layak huni.
        Surat Keterangan ini kami berikan kepada yang bersangkutan guna melengkapi persyaratan untuk mendapatkan Kartu
        {{ $surat->keperluan }}
    </p>

    <p style="line-height: 1.5; text-align: justify;">
        Demikian Surat Keterangan Tidak Mampu ini diperbuat dengan sebenarnya untuk dapat dipergunakan seperlunya.
    </p>

    {{ $signature ?? '' }}

</x-container-print>
