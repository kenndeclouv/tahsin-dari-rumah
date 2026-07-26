<x-layouts.app title="Isi Presensi">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Isi Presensi Santri</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4 p-3 bg-light rounded">
                        <div class="row">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <p class="mb-1 text-muted fs-13">Nama Santri</p>
                                <h6 class="mb-0 fw-bold">{{ $paket->santri->nama }}</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-1 text-muted fs-13">Pertemuan Ke</p>
                                <h6 class="mb-0 fw-bold">{{ $count + 1 }} dari {{ $paket->jumlah_pertemuan }}</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('presensi.store', $paket->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pertemuan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kehadiran <span class="text-danger">*</span></label>
                            <select name="kehadiran" class="form-select" required>
                                <option value="hadir">Hadir</option>
                                <option value="reschedule">Reschedule</option>
                                <option value="libur">Libur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto / Bukti (Real-time)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" capture="environment">
                            <small class="text-muted">Akan langsung membuka kamera belakang jika dibuka dari smartphone.</small>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="catatan" class="form-control" rows="3" placeholder="Opsional..."></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Presensi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
