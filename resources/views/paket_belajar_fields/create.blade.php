<x-layouts.app title="Tambah Field Paket Kelas">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Tambah Field Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('paket_belajar_fields.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Label <span class="text-danger">*</span></label>
                            <input type="text" name="label" class="form-control" required value="{{ old('label') }}" placeholder="Contoh: Asal Sekolah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name (Key di Database) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="Contoh: asal_sekolah">
                            <small class="text-muted">Hanya boleh huruf kecil, angka, dan underscore (_).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe Input <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="text">Text (Teks Pendek)</option>
                                <option value="number">Number (Angka)</option>
                                <option value="textarea">Textarea (Teks Panjang)</option>
                                <option value="select">Select (Dropdown)</option>
                                <option value="date">Date (Tanggal)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Opsi Pilihan (Hanya jika tipe Select)</label>
                            <input type="text" name="options" class="form-control" value="{{ old('options') }}" placeholder="Contoh: SD, SMP, SMA">
                            <small class="text-muted">Pisahkan dengan koma.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan Tampil (Order) <span class="text-danger">*</span></label>
                            <input type="number" name="order" class="form-control" required value="{{ old('order', 10) }}">
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="is_required" name="is_required" checked>
                            <label class="form-check-label" for="is_required">Wajib Diisi (Required)</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top border-dashed pt-3">
                            <a href="{{ route('paket_belajar_fields.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
