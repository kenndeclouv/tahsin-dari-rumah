<x-layouts.app title="Edit Field Santri">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit Field: {{ $santriField->label }}</h2>
                <a href="{{ route('santri_fields.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Kembali
                </a>
            </div>
            
            <div class="p-6">
                <form action="{{ route('santri_fields.update', $santriField->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Label <span class="text-red-500">*</span></label>
                            <input type="text" name="label" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('label', $santriField->label) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Name (Key di Database) <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('name', $santriField->name) }}">
                            <p class="text-sm text-gray-500 mt-2">Hanya boleh huruf kecil, angka, dan underscore (_).</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Tipe Input <span class="text-red-500">*</span></label>
                            <select name="type" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                <option value="text" {{ old('type', $santriField->type) == 'text' ? 'selected' : '' }}>Text (Teks Pendek)</option>
                                <option value="number" {{ old('type', $santriField->type) == 'number' ? 'selected' : '' }}>Number (Angka)</option>
                                <option value="textarea" {{ old('type', $santriField->type) == 'textarea' ? 'selected' : '' }}>Textarea (Teks Panjang)</option>
                                <option value="select" {{ old('type', $santriField->type) == 'select' ? 'selected' : '' }}>Select (Dropdown)</option>
                                <option value="date" {{ old('type', $santriField->type) == 'date' ? 'selected' : '' }}>Date (Tanggal)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Opsi Pilihan (Hanya jika tipe Select)</label>
                            <input type="text" name="options" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('options', $santriField->options ? implode(', ', $santriField->options) : '') }}">
                            <p class="text-sm text-gray-500 mt-2">Pisahkan dengan koma.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Urutan Tampil (Order) <span class="text-red-500">*</span></label>
                            <input type="number" name="order" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('order', $santriField->order) }}">
                        </div>

                        <div class="flex items-center">
                            <div class="flex">
                                <input type="checkbox" id="is_required" name="is_required" class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" {{ old('is_required', $santriField->is_required) ? 'checked' : '' }}>
                            </div>
                            <div class="ms-3">
                                <label for="is_required" class="text-sm font-medium text-gray-800">Wajib Diisi (Required)</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('santri_fields.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
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
