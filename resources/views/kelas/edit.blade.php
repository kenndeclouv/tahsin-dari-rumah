<x-layouts.app title="Edit Kelas">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Kelas</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('kelas.update', $kelasItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Santri <span class="text-red-500">*</span></label>
                            <x-searchable-select name="santri_id" required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}" {{ $kelasItem->santri_id == $santri->id ? 'selected' : '' }}>{{ $santri->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Pengajar <span class="text-red-500">*</span></label>
                            <x-searchable-select name="pengajar_id" required="true" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($pengajars as $pengajar)
                                    <option value="{{ $pengajar->id }}" {{ $kelasItem->pengajar_id == $pengajar->id ? 'selected' : '' }}>{{ $pengajar->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Hari & Jam <span class="text-red-500">*</span></label>
                            <input type="text" name="hari_jam" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ $kelasItem->hari_jam }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Fee Kelas</label>
                            <x-searchable-select name="paket_belajar_id" placeholder="Tanpa Fee Master" class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @foreach ($paketBelajars as $paketBelajar)
                                    <option value="{{ $paketBelajar->id }}" {{ $kelasItem->paket_belajar_id == $paketBelajar->id ? 'selected' : '' }}>{{ $paketBelajar->nama }}</option>
                                @endforeach
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jumlah Pertemuan <span class="text-red-500">*</span></label>
                            <x-searchable-select name="jumlah_pertemuan" placeholder="" required="true">
                                <option value="4" {{ $kelasItem->jumlah_pertemuan == 4 ? 'selected' : '' }}>4 Kali</option>
                                <option value="8" {{ $kelasItem->jumlah_pertemuan == 8 ? 'selected' : '' }}>8 Kali</option>
                                <option value="12" {{ $kelasItem->jumlah_pertemuan == 12 ? 'selected' : '' }}>12 Kali</option>
                                <option value="16" {{ $kelasItem->jumlah_pertemuan == 16 ? 'selected' : '' }}>16 Kali</option>
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status Kursus <span class="text-red-500">*</span></label>
                            <x-searchable-select name="status" placeholder="" required="true">
                                <option value="berjalan" {{ $kelasItem->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                <option value="menunggu_evaluasi" {{ $kelasItem->status == 'menunggu_evaluasi' ? 'selected' : '' }}>Menunggu Evaluasi</option>
                                <option value="selesai" {{ $kelasItem->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </x-searchable-select>
                        </div>
                    </div>


                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('kelas.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
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
