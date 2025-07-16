<x-container-print>
    <x-header-print />
    <x-title-print nomorSurat="{{ $surat->id }}/SKMD/2001/{{ \Carbon\Carbon::now()->format('Y') }}">
        {{ $slot }}
    </x-title-print>
    {{-- isi surat --}}
    <p style="line-height: 1.5; text-align: justify;font-family: 'Times New Roman', serif;">
        Yang bertanda tangan di bawah ini, Lurah Sorkam Kanan Kecamatan Sorkam Barat Kabupaten Tapanuli Tengah,
        menerangkan bahwa:
    </p>

    <table style="width: 100%; border-collapse: collapse;  margin-bottom: 20px;">
        <tbody style="text-transform: capitalize;">
            <tr>
                <td style="width: 30%; padding: 5px 0;">Nama</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->nama_almarhum }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Jenis Kelamin</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Tempat/Tanggal Lahir</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Agama</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->agama }}</td>
            </tr>
            {{-- <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Status Perkawinan</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->status_perkawinan }}</td>
            </tr> --}}
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Kewarganegaraan</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->kewarganegaraan }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Alamat</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->alamat }}</td>
            </tr>
        </tbody>
    </table>

    <p style="line-height: 1.5; text-align: justify;">
        Telah meninggal dunia pada:
    </p>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tbody style="text-transform: capitalize;">
            <tr>
                <td style="width: 30%; padding: 5px 0;">Tanggal</td>
                <td style="padding: 5px 0;text-transform: capitalize">:
                    &nbsp;{{ \Carbon\Carbon::parse($surat->tanggal_meninggal)->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Tempat</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->tempat_kematian }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;text-transform: capitalize">Disebabkan</td>
                <td style="padding: 5px 0;text-transform: capitalize">: &nbsp;{{ $surat->penyebab_meninggal }}</td>
            </tr>
        </tbody>
    </table>

    <p style="line-height: 1.5; text-align: justify;">
        Demikian surat keterangan ini kami perbuat agar dapat dipergunakan sebagaimana perlunya. Atas kerja sama yang
        baik, kami ucapkan terima kasih.
    </p>

    {{ $signature ?? '' }}

</x-container-print>
