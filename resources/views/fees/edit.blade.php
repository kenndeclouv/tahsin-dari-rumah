<x-layouts.app title="Edit Fee">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Edit Data Fee</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('fees.update', $fee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama / Deskripsi Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" required value="{{ old('nama', $fee->nama) }}">
                            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="nominal" class="form-control" required value="{{ old('nominal', $fee->nominal) }}">
                            @error('nominal') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('fees.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
