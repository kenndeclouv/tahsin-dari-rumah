<x-layouts.app title="Rekap Mukafaah">
    
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <nav class="flex px-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm w-full md:w-auto" aria-label="Breadcrumb">
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

        @if($listPengajars->count() > 0)
        <div class="w-full md:w-72">
            <form action="{{ route('mukafaah.index') }}" method="GET" class="relative">
                <select name="pengajar_id" onchange="this.form.submit()" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none shadow-sm">
                    <option value="">Semua Tutor</option>
                    @foreach($listPengajars as $lp)
                        <option value="{{ $lp->id }}" {{ $pengajarFilter == $lp->id ? 'selected' : '' }}>
                            {{ $lp->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        @endif
    </div>

    @forelse ($pengajars as $pengajar)
        @php
            $paketBelumLunas = $pengajar->kelas->where('payment_status', 'belum');
            $paketLunas = $pengajar->kelas->where('payment_status', 'lunas');
            
            $totalUangBelumLunas = $paketBelumLunas->sum(function($paket) {
                return $paket->paketBelajar ? $paket->paketBelajar->nominal : 0;
            });

            $totalUangLunas = $paketLunas->sum(function($paket) {
                return $paket->paketBelajar ? $paket->paketBelajar->nominal : 0;
            });
            
            $isSemuaLunas = $paketBelumLunas->count() === 0 && $paketLunas->count() > 0;
            
            // Di desain image 3, total (mukaafah + bonus) ditampilkan untuk SEMUA tagihan (belum lunas & lunas) atau HANYA yg belum lunas?
            // Biasanya dashboard finance per periode (misal bulan ini) menjumlahkan yg tertagih.
            // Kita jumlahkan semua tagihan belum lunas untuk tutor ini.
            
            $semuaPaket = $pengajar->kelas;
        @endphp

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6 overflow-hidden">
            <!-- Header (Dark) -->
            <div class="px-6 py-6 bg-gray-900 text-white flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center size-12 bg-blue-600 rounded-full text-lg font-bold text-white">
                        {{ substr($pengajar->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h5 class="text-xl font-bold">{{ $pengajar->name }}</h5>
                            @if($isSemuaLunas)
                                <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-bold bg-green-500 text-white rounded-md">
                                    <i class="fa-solid fa-check"></i> GAJI LUNAS (PAID)
                                </span>
                            @else
                                <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-bold bg-gray-700 text-gray-300 rounded-md">UNSETTLED COP</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="py-1 px-3 inline-flex items-center gap-x-1.5 text-xs font-medium border border-gray-600 text-gray-300 rounded-full">
                                <i class="fa-brands fa-whatsapp text-green-400"></i> {{ $pengajar->pengajar->additional_data['no_hp'] ?? '-' }}
                            </span>
                            <span class="py-1 px-3 inline-flex items-center gap-x-1.5 text-xs font-medium border border-gray-600 text-gray-300 rounded-full">
                                <i class="fa-solid fa-building-columns text-yellow-400"></i> 
                                {{ $pengajar->pengajar->additional_data['bank'] ?? 'Bank' }}: 
                                {{ $pengajar->pengajar->additional_data['no_rekening'] ?? '-' }}
                                @if(isset($pengajar->pengajar->additional_data['nama_rekening']))
                                    (a.n {{ $pengajar->pengajar->additional_data['nama_rekening'] }})
                                @endif
                                <i class="fa-regular fa-copy ml-1 cursor-pointer hover:text-white" onclick="navigator.clipboard.writeText('{{ $pengajar->pengajar->additional_data['no_rekening'] ?? '' }}'); alert('No Rekening dicopy!')"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-right flex items-center gap-6">
                    <div>
                        <p class="text-[10px] text-gray-400 mb-1 uppercase tracking-wider font-bold">Total Mukaafah Tutor Ini</p>
                        <h4 class="text-3xl font-bold text-yellow-500 mb-0">Rp {{ number_format($totalUangBelumLunas + $totalUangLunas, 0, ',', '.') }}</h4>
                        <p class="text-xs text-gray-400 mt-1">Bonus Tambahan <span class="text-green-500 font-bold ml-1">Rp 0</span></p>
                        <p class="text-sm text-gray-300 mt-2">TOTAL (MUKAAFAH + BONUS) <span class="text-yellow-500 font-bold ml-2">Rp {{ number_format($totalUangBelumLunas + $totalUangLunas, 0, ',', '.') }}</span></p>
                    </div>
                    @if(!$isSemuaLunas && $paketBelumLunas->count() > 0)
                        @can('mukafaahs:edit')
                        <form action="{{ route('mukafaah.payAll', $pengajar->id) }}" method="POST" class="ml-4">
                            @csrf
                            <button type="submit" class="flex flex-col items-center bg-gray-800 border border-gray-700 hover:bg-gray-700 transition rounded-xl p-2 px-3">
                                <span class="text-white text-xs font-bold mb-1">PAID SEMUA</span>
                                <div class="relative inline-flex items-center h-6 rounded-full w-12 transition-colors focus:outline-none bg-gray-500">
                                    <span class="inline-block w-4 h-4 transform translate-x-1 bg-white rounded-full transition-transform"></span>
                                </div>
                                <span class="text-[8px] text-gray-400 mt-1">Klik utk semua kelas</span>
                            </button>
                        </form>
                        @endcan
                    @endif
                </div>
            </div>
            
            <div class="p-6">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-white border-b border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-4 py-4 text-start text-xs font-bold text-gray-700 uppercase tracking-wider">Program & Kelas</th>
                                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Hitungan<br>(Sesi)</th>
                                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Skema</th>
                                        <th scope="col" class="px-4 py-4 text-end text-xs font-bold text-gray-700 uppercase tracking-wider">Tarif Base</th>
                                        <th scope="col" class="px-4 py-4 text-end text-xs font-bold text-gray-700 uppercase tracking-wider">Total<br>Mukaafah</th>
                                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Detail KBM</th>
                                        <th scope="col" class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status Gaji<br>(Finance)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($semuaPaket as $paket)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4">
                                            <span class="block text-sm font-bold text-gray-800">Tahsin Privat Offline</span>
                                            <span class="block text-xs text-gray-500 mt-1 uppercase">{{ $paket->santri->nama }} - {{ $pengajar->name }}</span>
                                            @if($paket->payment_status == 'lunas')
                                                <span class="mt-2 inline-flex items-center py-0.5 px-2 rounded text-[10px] font-medium bg-green-100 text-green-700">Settled COP</span>
                                            @else
                                                <span class="mt-2 inline-flex items-center py-0.5 px-2 rounded text-[10px] font-medium bg-gray-100 text-gray-600">Unsettled COP</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            <span class="text-sm font-bold text-blue-600">{{ $paket->jumlah_pertemuan }} Peserta</span>
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            <span class="inline-flex items-center py-1 px-2 rounded-full text-[10px] font-bold bg-cyan-100 text-cyan-600">Per Peserta</span>
                                        </td>
                                        <td class="px-4 py-4 text-end whitespace-nowrap">
                                            <span class="text-sm font-bold text-gray-800">
                                            @if($paket->paketBelajar)
                                                Rp {{ number_format($paket->paketBelajar->nominal / max($paket->jumlah_pertemuan, 1), 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-end whitespace-nowrap">
                                            <span class="text-sm font-bold text-red-500">
                                            @if($paket->paketBelajar)
                                                Rp {{ number_format($paket->paketBelajar->nominal, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('kelas.show', $paket->id) }}" class="inline-flex flex-col items-center justify-center w-12 h-12 rounded-full border-2 border-cyan-200 text-cyan-500 hover:bg-cyan-50 transition">
                                                <i class="fa-regular fa-eye text-sm"></i>
                                                <span class="text-[9px] font-bold mt-0.5">Detail<br>KBM</span>
                                            </a>
                                        </td>
                                        <td class="px-4 py-4 text-center whitespace-nowrap">
                                            @can('mukafaahs:edit')
                                            <form action="{{ route('mukafaah.pay', $paket->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @if($paket->payment_status == 'belum')
                                                <button type="submit" class="relative inline-flex items-center h-8 rounded-full w-16 transition-colors focus:outline-none bg-gray-300">
                                                    <span class="absolute right-2 text-[10px] font-bold text-gray-600">UNPAID</span>
                                                    <span class="inline-block w-6 h-6 transform translate-x-1 bg-white rounded-full transition-transform shadow-sm"></span>
                                                </button>
                                                @else
                                                <button type="submit" class="relative inline-flex items-center h-8 rounded-full w-16 transition-colors focus:outline-none bg-green-500">
                                                    <span class="absolute left-2 text-[10px] font-bold text-white">PAID</span>
                                                    <span class="inline-block w-6 h-6 transform translate-x-9 bg-white rounded-full transition-transform shadow-sm"></span>
                                                </button>
                                                @endif
                                            </form>
                                            @else
                                                @if($paket->payment_status == 'belum')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-[10px] font-bold bg-gray-200 text-gray-700">UNPAID</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-[10px] font-bold bg-green-100 text-green-700">PAID</span>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada tagihan tertunda.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-12 text-center">
            <svg class="size-16 text-primary-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <h5 class="text-xl font-semibold text-gray-800 mb-2">Belum ada kelas yang selesai</h5>
            <p class="text-gray-500">Jika pengajar menyelesaikan evaluasi kelas santri, data payroll akan muncul di sini.</p>
        </div>
    @endforelse
</x-layouts.app>
