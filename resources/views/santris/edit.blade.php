<x-layouts.app title="Edit Santri">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Data Santri</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('santris.update', $santri->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Basic Info -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('nama', $santri->nama) }}">
                            @error('nama') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">No WhatsApp / HP (Wajib) <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('no_hp', $santri->no_hp) }}" placeholder="Contoh: 08123456789">
                            @error('no_hp') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status Santri <span class="text-red-500">*</span></label>
                            <x-searchable-select name="status" placeholder="" required="true">
                                <option value="aktif" {{ old('status', $santri->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ old('status', $santri->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="nonaktif" {{ old('status', $santri->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </x-searchable-select>
                            @error('status') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h3>
                        </div>

                        @foreach ($fields as $field)
                            @php
                                $currentVal = old('additional_data.'.$field->name, $santri->additional_data[$field->name] ?? '');
                            @endphp
                            <div>
                                <label class="block text-sm font-medium mb-2">
                                    {{ $field->label }} 
                                    @if($field->is_required) <span class="text-red-500">*</span> @endif
                                </label>

                                @if ($field->type === 'textarea')
                                    <textarea name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" {{ $field->is_required ? 'required' : '' }}>{{ $currentVal }}</textarea>
                                
                                @elseif ($field->type === 'select')
                                    <x-searchable-select name="additional_data[{{ $field->name }}]" id="additional_data_{{ $field->name }}" placeholder="-- Pilih --" :required="$field->is_required">
                                        @foreach ($field->options as $option)
                                            <option value="{{ $option }}" {{ $currentVal == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </x-searchable-select>
                                
                                @else
                                    <input type="{{ $field->type }}" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $currentVal }}" {{ $field->is_required ? 'required' : '' }}>
                                @endif

                                @error('additional_data.'.$field->name)
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('santris.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
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
