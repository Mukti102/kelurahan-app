<div style="width: 100%; display: flex; margin-top: 150px;position: relative;">
    <div
        style="position:absolute;right: 10px; auto; font-size: 13px; text-align: center; display: flex; flex-direction: column; align-items: flex-end; margin-left: auto;">
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
