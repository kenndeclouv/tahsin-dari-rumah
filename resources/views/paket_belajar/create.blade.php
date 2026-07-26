<x-layouts.app title="Buat Paket Belajar">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Buat Paket Belajar Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('paket_belajars.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pilih Santri <span class="text-danger">*</span></label>
                                <x-searchable-select name="santri_id" placeholder="Pilih Santri..." required="true">
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id }}">{{ $santri->nama }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pilih Pengajar <span class="text-danger">*</span></label>
                                <x-searchable-select name="pengajar_id" placeholder="Pilih Pengajar..." required="true">
                                    @foreach ($pengajars as $pengajar)
                                        <option value="{{ $pengajar->id }}">{{ $pengajar->name }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hari & Jam <span class="text-danger">*</span></label>
                                <input type="text" name="hari_jam" class="form-control" placeholder="Contoh: Senin, 16:00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fee Paket (Opsional)</label>
                                <x-searchable-select name="fee_id" placeholder="Tidak Menggunakan Fee Master">
                                    @foreach ($fees as $fee)
                                        <option value="{{ $fee->id }}">{{ $fee->nama }} - Rp {{ number_format($fee->nominal, 0, ',', '.') }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Jumlah Pertemuan (Paket) <span class="text-danger">*</span></label>
                                <select name="jumlah_pertemuan" class="form-select" required>
                                    <option value="4">4 Kali Pertemuan</option>
                                    <option value="8">8 Kali Pertemuan</option>
                                    <option value="12">12 Kali Pertemuan</option>
                                    <option value="16">16 Kali Pertemuan</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fs-15 mb-3">Informasi Paket Kelas (Dynamic)</h6>

                        <div class="row">
                            @foreach ($dynamicFields as $field)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-danger">*</span> @endif
                                    </label>

                                    @if ($field->type === 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="form-control" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ old('additional_data.'.$field->name) }}</textarea>
                                    
                                    @elseif ($field->type === 'select')
                                        <select name="additional_data[{{ $field->name }}]" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}" {{ old('additional_data.'.$field->name) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    
                                    @else
                                        <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="form-control" value="{{ old('additional_data.'.$field->name) }}" {{ $field->is_required ? 'required' : '' }}>
                                    @endif

                                    @error('additional_data.'.$field->name)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('paket_belajars.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Paket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
