<x-layouts.app title="Edit Paket Belajar">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h5 class="header-title mb-0">Edit Paket Belajar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('paket_belajars.update', $paketBelajar->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pilih Santri <span class="text-danger">*</span></label>
                                <x-searchable-select name="santri_id" required="true">
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id }}" {{ $paketBelajar->santri_id == $santri->id ? 'selected' : '' }}>{{ $santri->nama }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pilih Pengajar <span class="text-danger">*</span></label>
                                <x-searchable-select name="pengajar_id" required="true">
                                    @foreach ($pengajars as $pengajar)
                                        <option value="{{ $pengajar->id }}" {{ $paketBelajar->pengajar_id == $pengajar->id ? 'selected' : '' }}>{{ $pengajar->name }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Hari & Jam <span class="text-danger">*</span></label>
                                <input type="text" name="hari_jam" class="form-control" value="{{ $paketBelajar->hari_jam }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Fee Paket</label>
                                <x-searchable-select name="fee_id" placeholder="Tanpa Fee Master">
                                    @foreach ($fees as $fee)
                                        <option value="{{ $fee->id }}" {{ $paketBelajar->fee_id == $fee->id ? 'selected' : '' }}>{{ $fee->nama }}</option>
                                    @endforeach
                                </x-searchable-select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label class="form-label">Jumlah Pertemuan <span class="text-danger">*</span></label>
                                <select name="jumlah_pertemuan" class="form-select" required>
                                    <option value="4" {{ $paketBelajar->jumlah_pertemuan == 4 ? 'selected' : '' }}>4 Kali</option>
                                    <option value="8" {{ $paketBelajar->jumlah_pertemuan == 8 ? 'selected' : '' }}>8 Kali</option>
                                    <option value="12" {{ $paketBelajar->jumlah_pertemuan == 12 ? 'selected' : '' }}>12 Kali</option>
                                    <option value="16" {{ $paketBelajar->jumlah_pertemuan == 16 ? 'selected' : '' }}>16 Kali</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label class="form-label">Status Kursus <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="berjalan" {{ $paketBelajar->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                    <option value="menunggu_evaluasi" {{ $paketBelajar->status == 'menunggu_evaluasi' ? 'selected' : '' }}>Menunggu Evaluasi</option>
                                    <option value="selesai" {{ $paketBelajar->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6 class="fs-15 mb-3">Informasi Paket Kelas (Dynamic)</h6>

                        <div class="row">
                            @foreach ($dynamicFields as $field)
                                @php
                                    $val = old('additional_data.'.$field->name, $paketBelajar->additional_data[$field->name] ?? '');
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-danger">*</span> @endif
                                    </label>

                                    @if ($field->type === 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="form-control" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ $val }}</textarea>
                                    
                                    @elseif ($field->type === 'select')
                                        <select name="additional_data[{{ $field->name }}]" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}" {{ $val == $option ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    
                                    @else
                                        <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="form-control" value="{{ $val }}" {{ $field->is_required ? 'required' : '' }}>
                                    @endif

                                    @error('additional_data.'.$field->name)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('paket_belajars.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
