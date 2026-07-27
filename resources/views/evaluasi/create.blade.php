<x-layouts.app title="Isi Evaluasi">
    <div class="max-w-4xl">
        <div class="bg-white border border-orange-200 rounded-xl shadow-sm overflow-hidden">
            
            <div class="px-6 py-4 border-b border-orange-200 bg-orange-50 flex items-center gap-2">
                <svg class="size-5 text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <h2 class="text-xl font-semibold text-orange-800">Evaluasi Paket Belajar</h2>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <p class="text-gray-600 text-sm">
                        Paket belajar untuk santri <span class="font-semibold text-gray-800">{{ $paket->santri->nama }}</span> telah selesai ({{ $paket->jumlah_pertemuan }} pertemuan). Silakan isi form evaluasi di bawah ini agar status santri menjadi Selesai.
                    </p>
                </div>

                <form action="{{ route('evaluasi.store', $paket->id) }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Perkembangan Bacaan <span class="text-red-500">*</span></label>
                            <textarea name="perkembangan_bacaan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Jelaskan sejauh mana perkembangan bacaan santri..." required></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800">Catatan Makhraj <span class="text-red-500">*</span></label>
                                <textarea name="makhraj" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Catatan mengenai pelafalan huruf..." required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800">Catatan Tajwid <span class="text-red-500">*</span></label>
                                <textarea name="tajwid" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Catatan mengenai hukum-hukum tajwid..." required></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Catatan Tambahan Pengajar</label>
                            <textarea name="catatan_pengajar" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none" rows="2" placeholder="Pesan atau catatan khusus (opsional)"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800">Saran Latihan Mandiri</label>
                            <textarea name="saran_latihan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none" rows="2" placeholder="Saran untuk dilatih di rumah (opsional)"></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('dashboard') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Nanti Saja
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-500 text-white hover:bg-orange-600 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Evaluasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
