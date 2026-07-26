<x-layouts.app title="Edit Field Santri">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Edit Field: {{ $santriField->label }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('santri_fields.update', $santriField->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Label <span class="text-danger">*</span></label>
                            <input type="text" name="label" class="form-control" required value="{{ old('label', $santriField->label) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name (Key di Database) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $santriField->name) }}">
                            <small class="text-muted">Hanya boleh huruf kecil, angka, dan underscore (_).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe Input <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="text" {{ old('type', $santriField->type) == 'text' ? 'selected' : '' }}>Text (Teks Pendek)</option>
                                <option value="number" {{ old('type', $santriField->type) == 'number' ? 'selected' : '' }}>Number (Angka)</option>
                                <option value="textarea" {{ old('type', $santriField->type) == 'textarea' ? 'selected' : '' }}>Textarea (Teks Panjang)</option>
                                <option value="select" {{ old('type', $santriField->type) == 'select' ? 'selected' : '' }}>Select (Dropdown)</option>
                                <option value="date" {{ old('type', $santriField->type) == 'date' ? 'selected' : '' }}>Date (Tanggal)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Opsi Pilihan (Hanya jika tipe Select)</label>
                            <input type="text" name="options" class="form-control" value="{{ old('options', $santriField->options ? implode(', ', $santriField->options) : '') }}">
                            <small class="text-muted">Pisahkan dengan koma.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan Tampil (Order) <span class="text-danger">*</span></label>
                            <input type="number" name="order" class="form-control" required value="{{ old('order', $santriField->order) }}">
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="is_required" name="is_required" {{ old('is_required', $santriField->is_required) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_required">Wajib Diisi (Required)</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top border-dashed pt-3">
                            <a href="{{ route('santri_fields.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
