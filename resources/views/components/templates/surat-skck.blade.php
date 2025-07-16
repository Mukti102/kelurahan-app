<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SPKCK/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>

    <p>Yang bertanda tangan di bawah ini, Kepala Desa Langkap, Kecamatan Kertanegara, Kabupaten Purbalingga, menerangkan
        bahwa:</p>
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
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>: {{ $surat->kewarganegaraan }}</td>
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
            <td>Status Perkawinan</td>
            <td>: {{ $surat->status_perkawinan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->alamat }}</td>
        </tr>
    </table>
    <p>
        Nama tersebut di atas adalah benar penduduk kami yang berdomisili di alamat tersebut di atas. Selain itu, kami
        terangkan bahwa orang tersebut benar berkelakuan baik, tidak pernah melakukan tindak pidana atau terlibat dalam
        organisasi terlarang, dan tidak pernah terjerumus dalam pergaulan bebas yang dapat merugikan dirinya sendiri
        serta masyarakat lain.
    </p>
    <p>
        Surat keterangan ini kami berikan kepada yang bersangkutan untuk memenuhi salah satu persyaratan melamar
        pekerjaan. Demikian surat keterangan ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana
        mestinya.
    </p>

    {{ $signature ?? '' }}

</x-container-print>
