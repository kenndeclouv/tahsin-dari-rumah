<x-layouts.app title="Isi Evaluasi">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card border-warning">
                <div class="card-header bg-warning-subtle border-bottom border-warning d-flex align-items-center gap-2">
                    <i class="ti ti-alert-circle text-warning fs-20"></i>
                    <h5 class="header-title mb-0 text-warning-emphasis">Evaluasi Paket Belajar</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Paket belajar untuk santri <strong>{{ $paket->santri->nama }}</strong> telah selesai ({{ $paket->jumlah_pertemuan }} pertemuan). Silakan isi form evaluasi di bawah ini agar status santri menjadi Selesai.
                    </p>

                    <form action="{{ route('evaluasi.store', $paket->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Perkembangan Bacaan <span class="text-danger">*</span></label>
                            <textarea name="perkembangan_bacaan" class="form-control" rows="2" placeholder="Jelaskan sejauh mana perkembangan bacaan santri..." required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Catatan Makhraj <span class="text-danger">*</span></label>
                                <textarea name="makhraj" class="form-control" rows="2" placeholder="Catatan mengenai pelafalan huruf..." required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Catatan Tajwid <span class="text-danger">*</span></label>
                                <textarea name="tajwid" class="form-control" rows="2" placeholder="Catatan mengenai hukum-hukum tajwid..." required></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan Pengajar</label>
                            <textarea name="catatan_pengajar" class="form-control" rows="2" placeholder="Pesan atau catatan khusus (opsional)"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Saran Latihan Mandiri</label>
                            <textarea name="saran_latihan" class="form-control" rows="2" placeholder="Saran untuk dilatih di rumah (opsional)"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-light">Nanti Saja</a>
                            <button type="submit" class="btn btn-warning">Simpan Evaluasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
