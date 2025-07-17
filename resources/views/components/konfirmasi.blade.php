<div class="row g-3 mb-4">
    <!-- Card Form -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-footer">
                <form action="{{ $action }}" method="POST">
                    @method('POST')
                    @csrf
                    <label for="keterangan" class="form-label mb-1">Keterangan</label>
                    <select class="form-select" id="keterangan" name="keterangan">
                        <option selected disabled>-- Pilih --</option>
                        <option>Data Belum Lengkap</option>
                        <option value="selesai">Konfirmasi</option>
                    </select>
                    <button class="btn mt-3 btn-success w-100 btn-rounded btn-sm" type="submit">
                        Konfirmasi Pengajuan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Card Berkas -->
    <div class="col-md-6">
    <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
            <h5 class="card-title mb-4 text-primary fw-semibold">📎 Daftar Berkas</h5>
            <section>
                @php
                    $berkas = is_string($surat->letter->berkas)
                        ? json_decode($surat->letter->berkas, true)
                        : $surat->letter->berkas;
                @endphp

                @forelse ($berkas as $file)
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-2 text-muted">
                            <i class="bi bi-file-earmark-text fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-medium">{{ ucwords(str_replace('_', ' ', $file['name'] ?? '-')) }}</div>
                            @if (!empty($file['path']))
                                <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="text-decoration-none small text-secondary">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat File
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada berkas yang tersedia.</p>
                @endforelse
            </section>
        </div>
    </div>
</div>

</div>
