<x-layouts.app title="Tambah Master Data Paket Belajar">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Master Data Paket Belajar Baru</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('paket_belajars.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama / Deskripsi Paket <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('nama') }}" placeholder="Contoh: Paket 1 (4x Pertemuan) Offline" autofocus>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Jenis Paket <span class="text-red-500">*</span></label>
                                <select name="jenis" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                    <option value="online" {{ old('jenis') == 'online' ? 'selected' : '' }}>Online</option>
                                    <option value="offline" {{ old('jenis') == 'offline' ? 'selected' : '' }}>Offline</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium mb-2">Jumlah Pertemuan <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah_pertemuan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('jumlah_pertemuan', 1) }}" min="1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Nominal (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="nominal" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required value="{{ old('nominal') }}" placeholder="Contoh: 150000">
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('paket_belajars.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Paket Belajar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
