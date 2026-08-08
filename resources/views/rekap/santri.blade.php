<x-layouts.app title="Rekap Tagihan Santri">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                
                {{-- Header & Filter --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Rekap Kehadiran & Tagihan Santri</h2>
                            <p class="text-sm text-gray-500">Laporan rekapitulasi kehadiran santri dan estimasi tagihan.</p>
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
                                @for($i = date('Y') - 2; $i <= date('Y') + 1; $i++)
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
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total Kehadiran (Bulan Ini)</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Estimasi Tagihan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($rekap as $data)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                        {{ $data['santri_nama'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            {{ $data['total_hadir'] }}x Hadir
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-semibold text-rose-600">
                                        Rp {{ number_format($data['estimasi_tagihan'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                            <p class="text-gray-500">Belum ada data presensi di bulan ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($rekap->count() > 0)
                        <tfoot class="bg-gray-50 font-semibold text-gray-800">
                            <tr>
                                <td class="px-6 py-4 text-end" colspan="2">Total Keseluruhan</td>
                                <td class="px-6 py-4 text-end text-rose-700">
                                    Rp {{ number_format($rekap->sum('estimasi_tagihan'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
