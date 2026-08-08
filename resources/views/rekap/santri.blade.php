<x-layouts.app title="Rekap Tagihan Santri">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                
                {{-- Header & Filter --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Rekap Kelas Selesai (Santri)</h2>
                            <p class="text-sm text-gray-500">Laporan daftar kelas yang telah selesai.</p>
                        </div>
                        
                        <form action="{{ route('rekap.santri') }}" method="GET" class="flex gap-3 items-center">
                            <select name="bulan" class="py-2 px-3 border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                            
                            <select name="tahun" class="py-2 px-3 border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500">
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
                </div>

                {{-- Table --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Santri</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Program/Paket</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($rekap as $data)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                        {{ $data->santri->nama ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $data->paketBelajar->nama_paket ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $data->updated_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('evaluasi.show', $data->id) }}" class="inline-flex items-center justify-center py-1.5 px-3 rounded-lg border border-primary-200 bg-primary-50 text-primary-700 shadow-sm hover:bg-primary-100 disabled:opacity-50 disabled:pointer-events-none text-xs font-medium" title="Lihat Evaluasi">
                                            Lihat Evaluasi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                            <p class="text-gray-500">Belum ada kelas yang selesai di bulan ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
