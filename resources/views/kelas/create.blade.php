<x-layouts.app title="Buat Kelas">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Buat Kelas Baru</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Santri <span class="text-red-500">*</span></label>
                            <x-searchable-select name="santri_id" placeholder="Pilih Santri..." required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}">{{ $santri->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Pengajar <span class="text-red-500">*</span></label>
                            <x-searchable-select name="pengajar_id" placeholder="Pilih Pengajar..." required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($pengajars as $pengajar)
                                    <option value="{{ $pengajar->id }}">{{ $pengajar->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Hari & Jam <span class="text-red-500">*</span></label>
                            <input type="text" name="hari_jam" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Contoh: Senin, 16:00" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Fee Paket (Opsional)</label>
                            <x-searchable-select name="paket_belajar_id" placeholder="Tidak Menggunakan Fee Master" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($paketBelajars as $paketBelajar)
                                    <option value="{{ $paketBelajar->id }}">{{ $paketBelajar->nama }} - Rp {{ number_format($paketBelajar->nominal, 0, ',', '.') }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jumlah Pertemuan <span class="text-red-500">*</span></label>
                            <x-searchable-select name="jumlah_pertemuan" placeholder="" required="true">
                                <option value="4">4 Kali Pertemuan</option>
                                <option value="8">8 Kali Pertemuan</option>
                                <option value="12">12 Kali Pertemuan</option>
                                <option value="16">16 Kali Pertemuan</option>
                            </x-searchable-select>
                        </div>
                    </div>

                    @if($dynamicFields->count() > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Informasi Kelas (Dynamic)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($dynamicFields as $field)
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-red-500">*</span> @endif
                                    </label>

                                    @if ($field->type === 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ old('additional_data.'.$field->name) }}</textarea>
                                    
                                    @elseif ($field->type === 'select')
                                        <x-searchable-select name="additional_data[{{ $field->name }}]" id="additional_data_{{ $field->name }}" placeholder="-- Pilih --" :required="$field->is_required">
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}" {{ old('additional_data.'.$field->name) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </x-searchable-select>
                                    
                                    @else
                                        <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('additional_data.'.$field->name) }}" {{ $field->is_required ? 'required' : '' }}>
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
                        <a href="{{ route('kelas.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
