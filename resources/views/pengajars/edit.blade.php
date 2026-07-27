<x-layouts.app title="Edit Pengajar">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Data Pengajar</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('pengajars.update', $pengajar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Kolom Kiri: Informasi Login -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Informasi Login</h3>
                            
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('name', $pengajar->name) }}">
                                @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Email (Username Login) <span class="text-red-500">*</span></label>
                                <input type="email" name="email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('email', $pengajar->email) }}">
                                @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="pt-4 mt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Password Baru</label>
                                        <input type="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" minlength="8">
                                        @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" minlength="8">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Data Diri -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Data Diri (Opsional)</h3>
                            
                            <div>
                                <label class="block text-sm font-medium mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="jenis_kelamin" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin', $pengajar->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $pengajar->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Nomor WhatsApp (HP)</label>
                                <input type="text" name="no_hp" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('no_hp', $pengajar->no_hp) }}" placeholder="Contoh: 08123456789">
                                @error('no_hp') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('pendidikan_terakhir', $pengajar->pendidikan_terakhir) }}" placeholder="Contoh: S1 Pendidikan Agama Islam">
                                @error('pendidikan_terakhir') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Alamat / Domisili</label>
                                <textarea name="alamat" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" rows="3">{{ old('alamat', $pengajar->alamat) }}</textarea>
                                @error('alamat') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium mb-2">Status Pengajar</label>
                                <select name="status" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <option value="aktif" {{ old('status', $pengajar->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $pengajar->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium mb-2">Catatan Admin (Opsional)</label>
                                <textarea name="admin_notes" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" rows="2" placeholder="Catatan internal khusus admin...">{{ old('admin_notes', $pengajar->admin_notes) }}</textarea>
                                @error('admin_notes') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    </div>

                    @if($customFields->count() > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Informasi Tambahan</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($customFields as $field)
                                @php
                                    $currentValue = $pengajar->additional_data[$field->name] ?? '';
                                @endphp
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        {{ $field->label }} 
                                        @if($field->is_required) <span class="text-red-500">*</span> @endif
                                    </label>
                                    
                                    @if($field->type == 'text')
                                        <input type="text" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                            
                                    @elseif($field->type == 'number')
                                        <input type="number" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                            
                                    @elseif($field->type == 'date')
                                        <input type="date" name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" 
                                            {{ $field->is_required ? 'required' : '' }} value="{{ old('additional_data.' . $field->name, $currentValue) }}">
                                            
                                    @elseif($field->type == 'textarea')
                                        <textarea name="additional_data[{{ $field->name }}]" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" 
                                            {{ $field->is_required ? 'required' : '' }}>{{ old('additional_data.' . $field->name, $currentValue) }}</textarea>
                                            
                                    @elseif($field->type == 'select')
                                        <select name="additional_data[{{ $field->name }}]" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" {{ $field->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih --</option>
                                            @foreach($field->options as $opt)
                                                <option value="{{ $opt }}" {{ old('additional_data.' . $field->name, $currentValue) == $opt ? 'selected' : '' }}>
                                                    {{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    @elseif($field->type == 'radio')
                                        <div class="flex flex-wrap gap-4 mt-2">
                                            @foreach($field->options as $idx => $opt)
                                                <div class="flex items-center">
                                                    <input type="radio" name="additional_data[{{ $field->name }}]" 
                                                        id="radio_{{ $field->name }}_{{ $idx }}" value="{{ $opt }}" 
                                                        class="shrink-0 mt-0.5 border-gray-200 rounded-full text-emerald-600 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none"
                                                        {{ old('additional_data.' . $field->name, $currentValue) == $opt ? 'checked' : '' }} 
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                    <label class="text-sm text-gray-700 ms-2" for="radio_{{ $field->name }}_{{ $idx }}">{{ $opt }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    @error('additional_data.' . $field->name)
                                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('pengajars.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
