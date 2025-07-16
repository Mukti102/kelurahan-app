<table style="width: 100%; border-bottom: 2px solid black; margin-bottom: 20px;">
    <tr>
        @php
            $data = file_get_contents('storage/' . $pengaturan->logo);
            $type = pathinfo('storage/' . $pengaturan->logo, PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        {{-- Logo di kiri --}}
        <td style="text-align: center; width: 100px;">
            <img src="{{ $base64 }}" alt="Logo" style="width: 80px; height: auto;">
        </td>
        
        <td style="text-align: center;">
            <h3 style="margin: 0; font-size: 21px;text-transform: uppercase">PEMERINTAH KABUPATEN
                {{ $pengaturan->kabupaten }}</h3>
            <h3 style="margin: 0; font-size: 21px;text-transform: uppercase">KECAMATAN {{ $pengaturan->kecamatan }}</h3>
            <h3 style="margin: 0; font-size: 21px;text-transform: uppercase">KELURAHAN {{ $pengaturan->keluarahan }}</h3>
            <p style="margin: 0; font-size: 14px;">KODE KELURAHAN: {{ $pengaturan->kode_kelurahan }}</p>
        </td>
    </tr>
</table>
