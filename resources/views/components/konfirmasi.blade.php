<div class="col-5">
    <div class="card shadow-sm">
        <div class="card-footer">
            <div class="row">
                <!-- Kolom Form -->
                <div class="col-md-12 mb-3">
                    <form action="{{ $action }}" method="POST" class="me-3">
                        @method('POST')
                        @csrf
                        <label for="keterangan" class="form-label mb-1">Keterangan</label>
                        <select class="form-select form-control-default" id="keterangan" name="keterangan">
                            <option selected disabled>-- Pilih --</option>
                            <option>Data Belum Lengkap</option>
                            <option value="selesai">Konfirmasi</option>
                        </select>
                        <button class="btn mt-3 btn-success w-100 btn-rounded btn-sm align-self-start" type="submit">
                            Konfirmasi Pengajuan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
