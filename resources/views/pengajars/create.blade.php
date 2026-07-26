<x-layouts.app title="Tambah Pengajar">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Tambah Pengajar Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengajars.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fs-15 mb-3">Informasi Login</h6>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email (Username Login) <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" required minlength="8">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fs-15 mb-3">Data Diri (Opsional)</h6>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor WhatsApp (HP)</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                                    @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan_terakhir" class="form-control" value="{{ old('pendidikan_terakhir') }}" placeholder="Contoh: S1 Pendidikan Agama Islam">
                                    @error('pendidikan_terakhir') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                                    @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        @if($customFields->count() > 0)
                        <hr class="border-dashed my-3">
                        <h6 class="fs-15 mb-3">Informasi Tambahan</h6>
                        <div class="row">
                            @foreach ($customFields as $field)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-danger">*</span> @endif
                                    </label>
                                    
                                    @if($field->type == 'text')
                                        <input type="text" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name) }}">
                                    @elseif($field->type == 'number')
                                        <input type="number" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name) }}">
                                    @elseif($field->type == 'date')
                                        <input type="date" name="additional_data[{{ $field->name }}]" class="form-control" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name) }}">
                                    @elseif($field->type == 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="form-control" rows="2" 
                                            {{ $field->is_required ? 'required' : '' }}>{{ old('additional_data.' . $field->name) }}</textarea>
                                    @elseif($field->type == 'select')
                                        <select name="additional_data[{{ $field->name }}]" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih --</option>
                                            @foreach($field->options as $opt)
                                                <option value="{{ $opt }}" {{ old('additional_data.' . $field->name) == $opt ? 'selected' : '' }}>
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
                                                        {{ old('additional_data.' . $field->name) == $opt ? 'checked' : '' }} 
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
