<x-layouts.app title="Rekap Mukafaah">
    
    <div class="mb-6">
        <nav class="flex px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Rekap Mukafaah (Payroll)</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    @forelse ($pengajars as $pengajar)
        @php
            $paketBelumLunas = $pengajar->kelas->where('payment_status', 'belum');
            $paketLunas = $pengajar->kelas->where('payment_status', 'lunas');
            
            $totalUangBelumLunas = $paketBelumLunas->sum(function($paket) {
                return $paket->paketBelajar ? $paket->paketBelajar->nominal : 0;
            });
        @endphp

        <div class="bg-white border border-blue-200 rounded-xl shadow-sm mb-6 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row justify-between md:items-center gap-4 bg-blue-50/50">
                <div class="flex items-center gap-x-3">
                    <img src="{{ $pengajar->photo_url }}" class="inline-block size-10 rounded-full ring-2 ring-white object-cover" alt="Image Description">
                    <h5 class="text-lg font-semibold text-gray-800">{{ $pengajar->name }}</h5>
                </div>
                <div class="md:text-right">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Tagihan Belum Dibayar</p>
                    <h4 class="text-xl font-bold text-red-600">Rp {{ number_format($totalUangBelumLunas, 0, ',', '.') }}</h4>
                </div>
            </div>
            
            <div class="p-6">
                <h6 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Daftar Kelas Selesai (Menunggu Pembayaran)</h6>
                
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Santri</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jadwal & Pertemuan</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Fee Kelas</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                                        @can('mukafaahs:edit')
                                        <th scope="col" class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($paketBelumLunas as $paket)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="block text-sm font-semibold text-gray-800">{{ $paket->santri->nama }}</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $paket->hari_jam }} ({{ $paket->jumlah_pertemuan }}x)
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            @if($paket->paketBelajar)
                                                Rp {{ number_format($paket->paketBelajar->nominal, 0, ',', '.') }}
                                            @else
                                                <span class="text-gray-400 italic">Tanpa Fee</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Belum Lunas</span>
                                        </td>
                                        @can('mukafaahs:edit')
                                        <td class="px-4 py-3 whitespace-nowrap text-end text-sm font-medium">
                                            <form action="{{ route('mukafaah.pay', $paket->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="py-1.5 px-3 inline-flex items-center gap-x-2 text-xs font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    Tandai Lunas
                                                </button>
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada tagihan tertunda.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($paketLunas->count() > 0)
            <div class="p-6 border-t border-gray-200 bg-gray-50/50">
                <h6 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Riwayat Lunas</h6>
                
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden bg-white opacity-80">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Santri</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jadwal & Pertemuan</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Fee Kelas</th>
                                        <th scope="col" class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                                        @can('mukafaahs:edit')
                                        <th scope="col" class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($paketLunas as $paket)
                                    <tr class="hover:bg-gray-50 text-gray-500">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $paket->santri->nama }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $paket->hari_jam }} ({{ $paket->jumlah_pertemuan }}x)</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            @if($paket->paketBelajar)
                                                Rp {{ number_format($paket->paketBelajar->nominal, 0, ',', '.') }}
                                            @else
                                                <span class="italic">Tanpa Fee</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Lunas</span>
                                        </td>
                                        @can('mukafaahs:edit')
                                        <td class="px-4 py-3 whitespace-nowrap text-end text-sm font-medium">
                                            <form action="{{ route('mukafaah.pay', $paket->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="py-1.5 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" onclick="return confirm('Yakin ingin membatalkan status lunas?')">
                                                    Batal Lunas
                                                </button>
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    @empty
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-12 text-center">
            <svg class="size-16 text-primary-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <h5 class="text-xl font-semibold text-gray-800 mb-2">Belum ada kelas yang selesai</h5>
            <p class="text-gray-500">Jika pengajar menyelesaikan evaluasi kelas santri, data payroll akan muncul di sini.</p>
        </div>
    @endforelse
</x-layouts.app>
