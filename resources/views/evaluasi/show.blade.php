<x-layouts.app title="Evaluasi Kelas - {{ $kelas->santri->nama }}">
    <div class="mb-6">
        <nav class="flex px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                        Dashboard
                    </a>
                </li>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('kelas.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ml-2">Kelas</a>
                    </div>
                </li>
                @endif
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Hasil Evaluasi</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sidebar Info -->
        <div class="flex flex-col gap-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
                <div class="inline-flex items-center justify-center size-20 rounded-full bg-primary-100 text-primary-600 mb-4 text-3xl font-bold">
                    {{ substr($kelas->santri->nama, 0, 1) }}
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-1">{{ $kelas->santri->nama }}</h4>
                <p class="text-sm text-gray-500 mb-4">{{ $kelas->santri->no_hp }}</p>
                
                <hr class="border-gray-200 my-4">
                
                <div class="text-start space-y-3 text-sm">
                    <div class="flex justify-between">
                        <strong class="text-gray-800">Pengajar:</strong> 
                        <span class="text-gray-600">{{ $kelas->pengajar->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-800">Jadwal:</strong> 
                        <span class="text-gray-600">{{ $kelas->hari_jam }}</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-800">Pertemuan:</strong> 
                        <span class="text-gray-600">{{ $kelas->jumlah_pertemuan }}x</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-800">Tgl Selesai:</strong> 
                        <span class="text-gray-600">{{ $kelas->evaluasi->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Content -->
        <div class="md:col-span-2">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Hasil Evaluasi Pembelajaran</h2>
                        <p class="text-sm text-gray-500 mt-1">Laporan akhir yang diberikan oleh pengajar untuk santri.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('evaluasi.public', $kelas->id) }}" target="_blank" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none py-2 px-3" title="Buka Halaman Publik">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                            Lihat Publik
                        </a>
                        <button onclick="copyPublicLink()" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none py-2 px-3 shadow-sm" title="Salin Link WA">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                            Copy Link
                        </button>
                    </div>
                </div>
                
                <div class="p-6 space-y-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 uppercase tracking-wide">1. Perkembangan Bacaan</h4>
                        <div class="p-4 bg-gray-50 border border-gray-100 rounded-lg whitespace-pre-wrap text-gray-600 text-sm">{{ $kelas->evaluasi->perkembangan_bacaan }}</div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 uppercase tracking-wide">2. Makhraj & Tajwid</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 border border-gray-100 rounded-lg">
                                <span class="block text-xs font-medium text-gray-500 mb-1">Makhraj</span>
                                <div class="whitespace-pre-wrap text-gray-600 text-sm">{{ $kelas->evaluasi->makhraj }}</div>
                            </div>
                            <div class="p-4 bg-gray-50 border border-gray-100 rounded-lg">
                                <span class="block text-xs font-medium text-gray-500 mb-1">Tajwid</span>
                                <div class="whitespace-pre-wrap text-gray-600 text-sm">{{ $kelas->evaluasi->tajwid }}</div>
                            </div>
                        </div>
                    </div>

                    @if($kelas->evaluasi->saran_latihan)
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 uppercase tracking-wide">3. Saran & Latihan Mandiri</h4>
                        <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg whitespace-pre-wrap text-blue-800 text-sm">{{ $kelas->evaluasi->saran_latihan }}</div>
                    </div>
                    @endif

                    @if($kelas->evaluasi->catatan_pengajar)
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 uppercase tracking-wide">4. Catatan Tambahan Pengajar</h4>
                        <div class="p-4 bg-amber-50 border border-amber-100 rounded-lg whitespace-pre-wrap text-amber-800 text-sm">{{ $kelas->evaluasi->catatan_pengajar }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        function copyPublicLink() {
            var publicUrl = "{{ route('evaluasi.public', $kelas->id) }}";
            navigator.clipboard.writeText(publicUrl).then(() => {
                alert("Link publik berhasil disalin! Silakan paste di WhatsApp.");
            }).catch(err => {
                console.error('Failed to copy!', err);
                var input = document.createElement("input");
                input.value = publicUrl;
                document.body.appendChild(input);
                input.select();
                document.execCommand("copy");
                document.body.removeChild(input);
                alert("Link publik berhasil disalin! Silakan paste di WhatsApp.");
            });
        }
    </script>
    @endpush
</x-layouts.app>
