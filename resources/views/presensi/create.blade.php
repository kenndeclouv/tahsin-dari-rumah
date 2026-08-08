<x-layouts.app title="Isi Presensi">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Isi Presensi Santri</h2>
            </div>
            
            <div class="p-6">
                <!-- Info Section -->
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Nama Santri</p>
                            <h3 class="text-base font-semibold text-gray-800">{{ $kelas->santri->nama }}</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <p class="text-sm font-medium text-gray-500">Progres Pertemuan</p>
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-primary-100 text-primary-800">
                                    {{ $count + 1 }} / {{ $kelas->jumlah_pertemuan }}
                                </span>
                            </div>
                            <div class="flex w-full h-2.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuenow="{{ (($count + 1) / $kelas->jumlah_pertemuan) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-600 text-xs text-white text-center whitespace-nowrap transition-all duration-500" style="width: {{ (($count + 1) / $kelas->jumlah_pertemuan) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('presensi.store', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal Pertemuan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Kehadiran <span class="text-red-500">*</span></label>
                            <x-searchable-select name="kehadiran" placeholder="" required="true">
                                <option value="hadir">Hadir</option>
                                <option value="reschedule">Reschedule</option>
                                <option value="libur">Libur</option>
                            </x-searchable-select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Foto / Bukti (Real-time)</label>
                            <input type="file" name="foto" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none
                                file:bg-gray-50 file:border-0
                                file:me-4
                                file:py-3 file:px-4" 
                                accept="image/*" capture="environment">
                            <p class="text-sm text-gray-500 mt-2">Akan langsung membuka kamera belakang jika dibuka dari smartphone.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Catatan Tambahan</label>
                            <textarea name="catatan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('dashboard') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Presensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
