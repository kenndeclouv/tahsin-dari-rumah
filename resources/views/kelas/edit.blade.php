<x-layouts.app title="Edit Kelas">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Kelas</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('paket_belajars.update', $paketBelajar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Santri <span class="text-red-500">*</span></label>
                            <x-searchable-select name="santri_id" required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}" {{ $paketBelajar->santri_id == $santri->id ? 'selected' : '' }}>{{ $santri->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Pengajar <span class="text-red-500">*</span></label>
                            <x-searchable-select name="pengajar_id" required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($pengajars as $pengajar)
                                    <option value="{{ $pengajar->id }}" {{ $paketBelajar->pengajar_id == $pengajar->id ? 'selected' : '' }}>{{ $pengajar->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Hari & Jam <span class="text-red-500">*</span></label>
                            <input type="text" name="hari_jam" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $paketBelajar->hari_jam }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Fee Kelas</label>
                            <x-searchable-select name="fee_id" placeholder="Tanpa Fee Master" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($fees as $fee)
                                    <option value="{{ $fee->id }}" {{ $paketBelajar->fee_id == $fee->id ? 'selected' : '' }}>{{ $fee->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jumlah Pertemuan <span class="text-red-500">*</span></label>
                            <x-searchable-select name="jumlah_pertemuan" placeholder="" required="true">
                                <option value="4" {{ $paketBelajar->jumlah_pertemuan == 4 ? 'selected' : '' }}>4 Kali</option>
                                <option value="8" {{ $paketBelajar->jumlah_pertemuan == 8 ? 'selected' : '' }}>8 Kali</option>
                                <option value="12" {{ $paketBelajar->jumlah_pertemuan == 12 ? 'selected' : '' }}>12 Kali</option>
                                <option value="16" {{ $paketBelajar->jumlah_pertemuan == 16 ? 'selected' : '' }}>16 Kali</option>
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status Kursus <span class="text-red-500">*</span></label>
                            <x-searchable-select name="status" placeholder="" required="true">
                                <option value="berjalan" {{ $paketBelajar->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                <option value="menunggu_evaluasi" {{ $paketBelajar->status == 'menunggu_evaluasi' ? 'selected' : '' }}>Menunggu Evaluasi</option>
                                <option value="selesai" {{ $paketBelajar->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </x-searchable-select>
                        </div>
                    </div>

                    @if($dynamicFields->count() > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Informasi Kelas (Dynamic)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($dynamicFields as $field)
                                @php
                                    $val = old('additional_data.'.$field->name, $paketBelajar->additional_data[$field->name] ?? '');
                                @endphp
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-red-500">*</span> @endif
                                    </label>

                                    @if ($field->type === 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ $val }}</textarea>
                                    
                                    @elseif ($field->type === 'select')
                                        <x-searchable-select name="additional_data[{{ $field->name }}]" id="additional_data_{{ $field->name }}" placeholder="-- Pilih --" :required="$field->is_required">
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}" {{ $val == $option ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </x-searchable-select>
                                    
                                    @else
                                        <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $val }}" {{ $field->is_required ? 'required' : '' }}>
                                    @endif

                                    @error('additional_data.'.$field->name)
                                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('paket_belajars.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
