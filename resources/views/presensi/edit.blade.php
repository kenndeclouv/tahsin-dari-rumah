<x-layouts.app title="Edit Presensi">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Presensi</h2>
            </div>
            
            <div class="p-6">
                <form action="{{ route('presensi.update', $presensi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($presensi->tanggal)->format('Y-m-d')) }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Kehadiran</label>
                            <select name="kehadiran" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500" required>
                                <option value="hadir" {{ old('kehadiran', $presensi->kehadiran) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="reschedule" {{ old('kehadiran', $presensi->kehadiran) == 'reschedule' ? 'selected' : '' }}>Reschedule</option>
                                <option value="libur" {{ old('kehadiran', $presensi->kehadiran) == 'libur' ? 'selected' : '' }}>Libur</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Catatan</label>
                            <textarea name="catatan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3">{{ old('catatan', $presensi->catatan) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('kelas.show', $presensi->kelas_id) }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
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
