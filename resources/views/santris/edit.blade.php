<x-layouts.app title="Edit Santri">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Edit Data Santri</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('santris.update', $santri->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" required value="{{ old('nama', $santri->nama) }}">
                            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No WhatsApp / HP (Wajib) <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" required value="{{ old('no_hp', $santri->no_hp) }}" placeholder="Contoh: 08123456789">
                            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Santri <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="aktif" {{ old('status', $santri->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ old('status', $santri->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="nonaktif" {{ old('status', $santri->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <hr>
                        <h6 class="fs-15 mb-3">Informasi Tambahan</h6>

                        @foreach ($fields as $field)
                            @php
                                $currentVal = old('additional_data.'.$field->name, $santri->additional_data[$field->name] ?? '');
                            @endphp
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ $field->label }} 
                                    @if($field->is_required) <span class="text-danger">*</span> @endif
                                </label>

                                @if ($field->type === 'textarea')
                                    <textarea name="additional_data[{{ $field->name }}]" class="form-control" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ $currentVal }}</textarea>
                                
                                @elseif ($field->type === 'select')
                                    <select name="additional_data[{{ $field->name }}]" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($field->options as $option)
                                            <option value="{{ $option }}" {{ $currentVal == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                
                                @else
                                    <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="form-control" value="{{ $currentVal }}" {{ $field->is_required ? 'required' : '' }}>
                                @endif

                                @error('additional_data.'.$field->name)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end gap-2 border-top border-dashed pt-3 mt-4">
                            <a href="{{ route('santris.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
