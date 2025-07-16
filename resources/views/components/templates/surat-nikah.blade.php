<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SPN/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>

    <p>Yang bertanda tangan di bawah ini menjelaskan dengan sesungguhnya bahwa:</p>

    <table style="width: 100%; border-collapse: collapse;  margin-bottom: 20px;">
        <tbody>
            <tr>
                <td style="width: 30%; padding: 5px 0;">1. Nama</td>
                <td style="padding: 5px 0;">: {{ $surat->nama_lengkap }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">2. Nomor Induk Kependudukan (NIK)</td>
                <td style="padding: 5px 0;">: {{ $surat->nik }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">3. Jenis Kelamin</td>
                <td style="padding: 5px 0;">: {{ $surat->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">4. Tempat dan Tanggal Lahir</td>
                <td style="padding: 5px 0;">: {{ $surat->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">5. Kewarganegaraan</td>
                <td style="padding: 5px 0;">: {{ $surat->kewarganegaraan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">6. Agama</td>
                <td style="padding: 5px 0;">: {{ $surat->agama }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">7. Pekerjaan</td>
                <td style="padding: 5px 0;">: {{ $surat->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">8. Alamat</td>
                <td style="padding: 5px 0;">: {{ $surat->alamat }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">9. Status Perkawinan</td>
                <td style="padding: 5px 0;">: {{ $surat->status_perkawinan }}</td>
            </tr>
        </tbody>
    </table>

    <p>Adalah benar anak dari pernikahan seorang pria:</p>
    <table style="width: 100%; border-collapse: collapse;  margin-bottom: 20px;">
        <tbody>
            <tr>
                <td style="width: 30%; padding: 5px 0;">Nama Lengkap dan Alias</td>
                <td style="padding: 5px 0;">: {{ $surat->nama_lengkap_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Nomor Induk Kependudukan (NIK)</td>
                <td style="padding: 5px 0;">: {{ $surat->nik_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Tempat dan Tanggal Lahir</td>
                <td style="padding: 5px 0;">: {{ $surat->tempat_lahir_ayah }},
                    {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ayah)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Kewarganegaraan</td>
                <td style="padding: 5px 0;">: {{ $surat->kewarganegaraan_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Agama</td>
                <td style="padding: 5px 0;">: {{ $surat->agama_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Pekerjaan</td>
                <td style="padding: 5px 0;">: {{ $surat->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Alamat</td>
                <td style="padding: 5px 0;">: {{ $surat->alamat_ayah }}</td>
            </tr>
        </tbody>
    </table>

    <p>dengan seorang wanita:</p>
    <table style="width: 100%; border-collapse: collapse; ">
        <tbody>
            <tr>
                <td style="width: 30%; padding: 5px 0;">Nama Lengkap dan Alias</td>
                <td style="padding: 5px 0;">: {{ $surat->nama_lengkap_ibu }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Nomor Induk Kependudukan (NIK)</td>
                <td style="padding: 5px 0;">: {{ $surat->nik_ibu }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Tempat dan Tanggal Lahir</td>
                <td style="padding: 5px 0;">: {{ $surat->tempat_lahir_ibu }},
                    {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ibu)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Kewarganegaraan</td>
                <td style="padding: 5px 0;">: {{ $surat->kewarganegaraan_ibu }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Agama</td>
                <td style="padding: 5px 0;">: {{ $surat->agama_ayah }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Pekerjaan</td>
                <td style="padding: 5px 0;">: {{ $surat->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">Alamat</td>
                <td style="padding: 5px 0;">: {{ $surat->alamat_ibu }}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 16px;">
        Demikian, surat pengantar ini dibuat dengan mengingat sumpah jabatan dan untuk dipergunakan sebagaimana
        mestinya.
    </p>
    {{ $signature ?? '' }}

</x-container-print>
