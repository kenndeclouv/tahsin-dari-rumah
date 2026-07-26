<x-layouts.app title="Edit Pengajar">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Edit Data Pengajar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengajars.update', $pengajar->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fs-15 mb-3">Informasi Login</h6>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required value="{{ old('name', $pengajar->name) }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email (Username Login) <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required value="{{ old('email', $pengajar->email) }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                
                                <hr class="my-4">
                                <p class="text-muted fs-13 mb-3">Kosongkan jika tidak ingin mengubah password.</p>
                                
                                <div class="mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="password" class="form-control" minlength="8">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control" minlength="8">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fs-15 mb-3">Data Diri (Opsional)</h6>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin', $pengajar->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $pengajar->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor WhatsApp (HP)</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pengajar->no_hp) }}">
                                    @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan_terakhir" class="form-control" value="{{ old('pendidikan_terakhir', $pengajar->pendidikan_terakhir) }}" placeholder="Contoh: S1 Pendidikan Agama Islam">
                                    @error('pendidikan_terakhir') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat / Domisili</label>
                                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pengajar->alamat) }}</textarea>
                                    @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status Pengajar</label>
                                    <select name="status" class="form-select">
                                        <option value="aktif" {{ old('status', $pengajar->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $pengajar->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Catatan Admin (Opsional)</label>
                                    <textarea name="admin_notes" class="form-control" rows="2" placeholder="Catatan internal khusus admin...">{{ old('admin_notes', $pengajar->admin_notes) }}</textarea>
                                    @error('admin_notes') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        @if($customFields->count() > 0)
                        <hr class="border-dashed my-3">
                        <h6 class="fs-15 mb-3">Informasi Tambahan</h6>
                        <div class="row">
                            @foreach ($customFields as $field)
                                @php
                                    $currentValue = $pengajar->additional_data[$field->name] ?? '';
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-danger">*</span> @endif
                                    </label>
                                    
                                    @if($field->type == 'text')
                                        <input type="text" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                    @elseif($field->type == 'number')
                                        <input type="number" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                    @elseif($field->type == 'date')
                                        <input type="date" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                    @elseif($field->type == 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="form-control" rows="2" 
                                            {{ $field->is_required ? 'required' : '' }}>{{ old('additional_data.' . $field->name, $currentValue) }}</textarea>
                                    @elseif($field->type == 'select')
                                        <select name="additional_data[{{ $field->name }}]" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih --</option>
                                            @foreach($field->options as $opt)
                                                <option value="{{ $opt }}" {{ old('additional_data.' . $field->name, $currentValue) == $opt ? 'selected' : '' }}>
                                                    {{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif($field->type == 'radio')
                                        <div>
                                            @foreach($field->options as $idx => $opt)
                                                <div class="form-check form-check-inline mt-1">
                                                    <input class="form-check-input" type="radio" name="additional_data[{{ $field->name }}]" 
                                                        id="radio_{{ $field->name }}_{{ $idx }}" value="{{ $opt }}" 
                                                        {{ old('additional_data.' . $field->name, $currentValue) == $opt ? 'checked' : '' }} 
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                    <label class="form-check-label" for="radio_{{ $field->name }}_{{ $idx }}">{{ $opt }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    @error('additional_data.' . $field->name)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-end gap-2 border-top border-dashed pt-3 mt-2">
                            <a href="{{ route('pengajars.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
