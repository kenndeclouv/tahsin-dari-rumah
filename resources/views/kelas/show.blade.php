<x-layouts.app title="Detail Kelas - {{ $kelas->santri?->nama ?? 'Santri Dihapus' }}">
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Kelas</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Kelas {{ $kelas->paketBelajar->nama_paket ?? 'Umum' }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Jadwal: {{ $kelas->hari_jam }}</p>
                </div>
                <div>
                    @if ($kelas->status == 'berjalan')
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-sm font-medium bg-blue-100 text-blue-800">Berjalan</span>
                    @elseif ($kelas->status == 'menunggu_evaluasi')
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-sm font-medium bg-orange-100 text-orange-800">Menunggu Evaluasi</span>
                    @elseif ($kelas->status == 'selesai')
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-sm font-medium bg-primary-100 text-primary-800">Selesai</span>
                    @endif
                </div>
            </div>
            
            <hr class="border-gray-200 my-4">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center gap-3">
                    <div class="inline-flex items-center justify-center size-12 rounded-full bg-blue-100 text-blue-600 font-bold text-xl">
                        {{ substr($kelas->santri?->nama ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Santri</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $kelas->santri?->nama ?? 'Santri Dihapus' }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="inline-flex items-center justify-center size-12 rounded-full bg-purple-100 text-purple-600 font-bold text-xl">
                        <img src="{{ $kelas->pengajar?->photo_url ?? 'https://ui-avatars.com/api/?name=P&background=random' }}" class="size-12 rounded-full object-cover" alt="Pengajar">
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Pengajar</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $kelas->pengajar?->nama ?? 'Pengajar Dihapus' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex flex-col justify-center">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Progres Pertemuan</h3>
            <div class="flex items-end gap-2 mb-2">
                <span class="text-3xl font-bold text-gray-800">{{ $kelas->presensis->count() }}</span>
                <span class="text-gray-500 mb-1">/ {{ $kelas->jumlah_pertemuan }}</span>
            </div>
            
            @php
                $percent = $kelas->jumlah_pertemuan > 0 ? ($kelas->presensis->count() / $kelas->jumlah_pertemuan) * 100 : 0;
            @endphp
            <div class="flex w-full h-2.5 bg-gray-200 rounded-full overflow-hidden mb-4">
                <div class="flex flex-col justify-center overflow-hidden bg-primary-500" role="progressbar" style="width: {{ $percent }}%"></div>
            </div>
            
            @if ($kelas->evaluasi)
                @can('evaluasis:view')
                <a href="{{ route('evaluasi.show', $kelas->id) }}" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-primary-200 bg-primary-50 text-primary-700 shadow-sm hover:bg-primary-100">
                    <i class="fa-solid fa-file-contract"></i> Lihat Evaluasi
                </a>
                @endcan
            @elseif($kelas->status == 'menunggu_evaluasi')
                @can('evaluasis:create')
                <a href="{{ route('evaluasi.create', $kelas->id) }}" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-orange-600 text-white shadow-sm hover:bg-orange-700">
                    <i class="fa-solid fa-file-pen"></i> Isi Evaluasi
                </a>
                @endcan
            @endif

            @if($kelas->status == 'selesai')
                @can('kelas:create')
                <form action="{{ route('kelas.duplicate', $kelas->id) }}" method="POST" class="mt-2 w-full" onsubmit="event.preventDefault(); confirmDelete(this, 'Yakin ingin melanjutkan paket ini? Ini akan membuat kelas baru dengan santri dan pengajar yang sama.')">
                    @csrf
                    <button type="submit" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white shadow-sm hover:bg-indigo-700">
                        <i class="fa-solid fa-copy"></i> Lanjut Paket Baru
                    </button>
                </form>
                @endcan
            @endif
        </div>
    </div>

    <!-- Presensi History Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Presensi</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pertemuan Ke-</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kehadiran</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Catatan</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Foto Bukti</th>
                        @can('presensis:edit')
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($kelas->presensis as $index => $presensi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                Pertemuan {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($presensi->tanggal)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($presensi->kehadiran == 'hadir')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-green-100 text-green-800">Hadir</span>
                                @elseif($presensi->kehadiran == 'reschedule')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">Reschedule</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Libur</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 min-w-[200px]">
                                {{ $presensi->catatan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($presensi->foto)
                                    <button type="button" onclick="openImagePreview('{{ asset('storage/' . $presensi->foto) }}')" class="inline-block relative group cursor-pointer border-0 bg-transparent p-0" title="Lihat Foto Full">
                                        <img src="{{ asset('storage/' . $presensi->foto) }}" class="size-12 rounded-lg object-cover border border-gray-200 group-hover:opacity-75 transition-opacity" alt="Bukti Kehadiran">
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="bg-black/50 rounded-full p-1 text-white">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 italic">Tidak ada foto</span>
                                @endif
                            </td>
                            @can('presensis:edit')
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <a href="{{ route('presensi.edit', $presensi->id) }}" class="text-primary-600 hover:text-primary-900 mr-3">Edit</a>
                                <form action="{{ route('presensi.destroy', $presensi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin menghapus presensi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col justify-center items-center">
                                    <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    <p class="text-gray-500">Belum ada riwayat presensi untuk kelas ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
