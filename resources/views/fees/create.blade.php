<x-layouts.app title="Tambah Fee">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Tambah Fee Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('fees.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama / Deskripsi Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Misal: Tahsin 4x Pertemuan" required value="{{ old('nama') }}">
                            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="nominal" class="form-control" placeholder="Misal: 400000" required value="{{ old('nominal') }}">
                            @error('nominal') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('fees.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
