<x-layouts.app title="Kelola Kelas">

    <x-slot:actions>
        @can('kelas:create')
            <a href="{{ route('kelas.create') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Buat Kelas Baru
            </a>
        @endcan
    </x-slot:actions>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4 bg-gray-50">
                        <div class="flex items-center gap-3">
                            <h2 class="text-xl font-semibold text-gray-800">Daftar Kelas</h2>
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                {{ $kelasList->count() }} Kelas
                            </span>
                        </div>

                        <form action="{{ route('kelas.index') }}" method="GET" class="flex gap-3 items-center">
                            <select name="bulan" class="py-2 px-3 border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="all" {{ $bulan === 'all' ? 'selected' : '' }}>Semua Bulan</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                            
                            <select name="tahun" class="py-2 px-3 border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="all" {{ $tahun === 'all' ? 'selected' : '' }}>Semua Tahun</option>
                                @php
                                    $firstKelas = \App\Models\Kelas::orderBy('created_at', 'asc')->first();
                                    $startYear = $firstKelas ? $firstKelas->created_at->format('Y') : date('Y');
                                    $endYear = date('Y') + 5;
                                @endphp
                                @for($i = $startYear; $i <= $endYear; $i++)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700">
                                Filter
                            </button>
                        </form>
                    </div>

                    {{-- Table --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Santri</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pengajar</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jadwal</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Target Pertemuan</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                                @canany(['kelas:edit', 'kelas:delete', 'presensis:create'])
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($kelasList as $kelasItem)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $kelasItem->santri->nama }}</span>
                                        @if(isset($kelasItem->additional_data['nama_paket']))
                                            <span class="block text-xs text-gray-500 mt-1">{{ $kelasItem->additional_data['nama_paket'] }}</span>
                                        @endif
                                        @if(isset($kelasItem->additional_data['tipe_kelas']) || isset($kelasItem->additional_data['metode_belajar']))
                                            <span class="block text-xs text-gray-500 mt-1">
                                                {{ $kelasItem->additional_data['tipe_kelas'] ?? '' }} 
                                                {{ isset($kelasItem->additional_data['metode_belajar']) ? ' - ' . $kelasItem->additional_data['metode_belajar'] : '' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kelasItem->pengajar->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kelasItem->hari_jam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kelasItem->jumlah_pertemuan }}x</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($kelasItem->status == 'berjalan')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Berjalan</span>
                                        @elseif ($kelasItem->status == 'menunggu_evaluasi')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-amber-100 text-amber-800">Menunggu Evaluasi</span>
                                        @elseif ($kelasItem->status == 'selesai')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Selesai</span>
                                        @endif
                                    </td>
                                    @canany(['kelas:edit', 'kelas:delete', 'presensis:create'])
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <div class="flex items-center justify-end">
                                                <x-action-dropdown>
                                                    <a href="{{ route('kelas.show', $kelasItem->id) }}" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                        <i class="fa-solid fa-eye text-gray-400"></i> Detail
                                                    </a>
                                                    @can('presensis:create')
                                                        @if ($kelasItem->status == 'berjalan')
                                                            <a href="{{ route('presensi.create', $kelasItem->id) }}" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-primary-600 hover:bg-primary-50 focus:outline-none focus:bg-primary-50">
                                                                <i class="fa-solid fa-clipboard-check text-primary-400"></i> Isi Presensi
                                                            </a>
                                                        @endif
                                                    @endcan
                                                    @if ($kelasItem->status == 'selesai')
                                                        <a href="{{ route('evaluasi.show', $kelasItem->id) }}" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-primary-600 hover:bg-primary-50 focus:outline-none focus:bg-primary-50">
                                                            <i class="fa-solid fa-file-contract text-primary-400"></i> Lihat Evaluasi
                                                        </a>
                                                        <a href="{{ route('evaluasi.public', $kelasItem->id) }}" target="_blank" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-green-600 hover:bg-green-50 focus:outline-none focus:bg-green-50">
                                                            <i class="fa-solid fa-share-nodes text-green-400"></i> Link Public Rapor
                                                        </a>
                                                    @endif
                                                    @can('kelas:edit')
                                                        <a href="{{ route('kelas.edit', $kelasItem->id) }}" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                            <i class="fa-solid fa-pen-to-square text-gray-400"></i> Edit
                                                        </a>
                                                    @endcan
                                                    @can('kelas:delete')
                                                        <form action="{{ route('kelas.destroy', $kelasItem->id) }}" method="POST" class="inline-block w-full" onsubmit="event.preventDefault(); confirmDelete(this, 'Yakin menghapus kelas ini? Seluruh data presensi dan evaluasi di dalamnya akan ikut terhapus.')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="w-full flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50">
                                                                <i class="fa-solid fa-trash-can text-red-400"></i> Hapus
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </x-action-dropdown>
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                            <p class="text-gray-500 mb-2">Belum ada kelas.</p>
                                            @can('kelas:create')
                                                <a href="{{ route('kelas.create') }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">Buat sekarang</a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
