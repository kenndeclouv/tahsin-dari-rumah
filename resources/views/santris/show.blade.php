<x-layouts.app title="Detail Santri - {{ $santri->nama }}">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Profile -->
        <div class="flex flex-col gap-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
                <div class="inline-flex items-center justify-center size-20 rounded-full bg-primary-100 text-primary-600 mb-4 text-3xl font-bold">
                    {{ substr($santri->nama, 0, 1) }}
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-1">{{ $santri->nama }}</h4>
                <p class="text-sm text-gray-500 mb-4">{{ $santri->no_hp }}</p>
                
                <hr class="border-gray-200 my-4">
                
                <div class="text-start">
                    <p class="mb-3 text-sm flex items-center justify-between">
                        <strong class="text-gray-800">Status:</strong> 
                        @if($santri->status == 'aktif')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Aktif</span>
                        @elseif($santri->status == 'selesai')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Selesai</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </p>
                    
                    <h6 class="text-sm font-semibold text-gray-800 mt-6 mb-3">Informasi Tambahan:</h6>
                    @if($santri->additional_data)
                        <div class="space-y-3">
                            @foreach($santri->additional_data as $key => $value)
                                @php
                                    $label = ucwords(str_replace('_', ' ', $key));
                                @endphp
                                <div>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">{{ $label }}</span>
                                    <span class="block text-sm font-medium text-gray-800">{{ $value ?: '-' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 italic">Belum ada informasi tambahan.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content (Riwayat Kelas) -->
        <div class="lg:col-span-2">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            
                            <!-- Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-800">Riwayat Kelas</h2>
                            </div>
                            
                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Pengajar</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal (Hari & Jam)</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Status Kelas</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($kelasList as $kelasItem)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                {{ $kelasItem->pengajar->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $kelasItem->hari_jam }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $kelasItem->jumlah_pertemuan }}x Pertemuan
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $kelasItem->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($kelasItem->status == 'berjalan')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Berjalan</span>
                                                @elseif ($kelasItem->status == 'menunggu_evaluasi')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-orange-100 text-orange-800">Menunggu Evaluasi</span>
                                                @elseif ($kelasItem->status == 'selesai')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                @if ($kelasItem->status == 'selesai')
                                                    <a href="{{ route('evaluasi.show', $kelasItem->id) }}" class="inline-flex items-center justify-center py-1.5 px-3 rounded-lg border border-primary-200 bg-primary-50 text-primary-700 shadow-sm hover:bg-primary-100 disabled:opacity-50 disabled:pointer-events-none text-xs font-medium" title="Lihat Evaluasi">
                                                        Lihat Evaluasi
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                                Santri ini belum memiliki kelas.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
