<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SKP-OT/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>
    <p>Yang bertanda tangan di bawah ini, Lurah Sorkam Kanan, Kecamatan Sorkam Barat, Kabupaten Tapanuli Tengah, dengan
        ini menerangkan dengan sebenarnya:</p>
    <table style="width: 100%;text-transform: capitalize; margin-bottom: 20px; ">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: {{ $surat->nama_pemohon }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $surat->nik_pemohon }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $surat->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $surat->agama }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $surat->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->alamat }}</td>
        </tr>
    </table>
    <p>Adalah benar orang tua dari:</p>
    <table style="width: 100%; margin-bottom: 20px; ">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: {{ $surat->nama_anak }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $surat->nik_anak }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $surat->jenis_kelamin_anak }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>: {{ $surat->tempat_lahir }},{{ \Carbon\Carbon::parse($surat->tanggal_lahir_anak)->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $surat->agama_anak }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $surat->pekerjaan_anak }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->alamat_anak }}</td>
        </tr>
    </table>
    <p>Nama tersebut di atas adalah benar penduduk Kelurahan Sorkam Kanan, Kecamatan Sorkam Barat, Kabupaten Tapanuli
        Tengah. Dan sepanjang pengetahuan kami, nama yang disebut di atas tersebut memiliki penghasilan Rp.
        {{ $surat->penghasilan }}
        .</p>
    <p>Demikian Surat Keterangan Penghasilan Orang Tua ini diperbuat dengan sebenar-benarnya agar dapat dipergunakan
        sebagaimana mestinya.</p>


    {{ $signature ?? '' }}


</x-container-print>
