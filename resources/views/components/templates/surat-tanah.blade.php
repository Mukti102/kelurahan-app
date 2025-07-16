<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SKT/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>
    <p>Yang bertanda tangan di bawah ini, Lurah Sorkam Kanan, Kecamatan Sorkam Barat, Kabupaten Tapanuli Tengah,
        menerangkan dengan sebenarnya bahwa:</p>
    <table style="width: 100%;text-transform: capitalize; margin-bottom: 20px;">
        <tr>
            <td style="width: 30%;">Nama</td>
            <td>: {{ $surat->nama_pemohon }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>: {{ $surat->umur }}</td>
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
    <p>
        Adalah benar mempunyai/memiliki Tanah yang terletak di
        {{ $surat->lokasi_tanah }} Sorkam Kanan,
        Kecamatan Sorkam Barat, Kabupaten Tapanuli Tengah, dengan batas-batasnya sebagai berikut:
    </p>
    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td style="width: 30%;">Sebelah Utara</td>
            <td>: {{ $surat->batas_utara }}</td>
        </tr>
        <tr>
            <td>Sebelah Selatan</td>
            <td>: {{ $surat->batas_selatan }}</td>
        </tr>
        <tr>
            <td>Sebelah Timur</td>
            <td>: {{ $surat->batas_timur }}</td>
        </tr>
        <tr>
            <td>Sebelah Barat</td>
            <td>: {{ $surat->batas_barat }}</td>
        </tr>
    </table>
    <p>
        Selanjutnya diterangkan sepanjang yang kami ketahui, tanah .............................................
        tersebut tidak terdapat silang sengketa baik mengenai batas-batasnya maupun penguasaannya/pemiliknya dan tidak
        tersangkut dengan pihak manapun.
    </p>
    <p>
        Demikian Surat Keterangan Tanah ini diperbuat dengan sebenarnya untuk dapat dipergunakan seperlunya.
    </p>
    {{ $signature ?? '' }}

</x-container-print>
