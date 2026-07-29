<x-layouts.app title="Dashboard">
    <!-- Welcome & Clock Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Welcome Card -->
        <div class="md:col-span-2 relative overflow-hidden rounded-xl bg-gradient-to-br from-primary-800 to-primary-600 text-white shadow-sm">
            <div class="p-6 sm:p-8 flex items-center gap-5">
                <img src="{{ auth()->user()->photo_url }}" class="size-20 rounded-full border-4 border-white/30 object-cover" alt="Avatar">
                <div>
                    <p class="text-primary-100 text-sm font-medium mb-1">Selamat datang kembali,</p>
                    <h2 class="text-2xl sm:text-3xl font-bold">{{ auth()->user()->name }}</h2>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach (auth()->user()->roles as $role)
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-sm">
                                <i class="fa-solid fa-shield-check shrink-0 size-5"></i>
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Clock Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center justify-center text-center">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Waktu Sekarang</p>
            <div id="live-clock" class="text-4xl sm:text-5xl font-bold text-gray-800 tracking-wider tabular-nums mb-2">
                --:--:--
            </div>
            <p id="live-date" class="text-sm text-gray-500 font-medium">---</p>
        </div>
    </div>

    <!-- Admin Metrics -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        
        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Pengajar Aktif</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-primary-600">{{ $pengajarAktif }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-primary-100 text-primary-600 rounded-full">
                    <i class="fa-solid fa-user-check text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Santri Aktif</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-blue-600">{{ $santriAktif }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-blue-100 text-blue-600 rounded-full">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Jadwal Mengajar</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-purple-600">{{ $jadwalHariIni }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-purple-100 text-purple-600 rounded-full">
                    <i class="fa-solid fa-calendar text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Presensi Hari Ini</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-indigo-600">{{ $presensiRatio }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-indigo-100 text-indigo-600 rounded-full">
                    <i class="fa-solid fa-list-check text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Kelas Berjalan</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-cyan-600">{{ $paketBerjalan }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-cyan-100 text-cyan-600 rounded-full">
                    <i class="fa-solid fa-person-running text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Menunggu Evaluasi</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-orange-600">{{ $evaluasiBelumDibuat }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-orange-100 text-orange-600 rounded-full">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Selesai Evaluasi</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-primary-600">{{ $paketSelesai }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-primary-100 text-primary-600 rounded-full">
                    <i class="fa-solid fa-file-circle-check text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Mukafaah Siap</p>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-rose-600">{{ $mukafaahSiap }}</h3>
                    </div>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-rose-100 text-rose-600 rounded-full">
                    <i class="fa-solid fa-coins text-xl"></i>
                </div>
            </div>
        </div>

    </div>
    @else
    
    <!-- Pengajar Metrics -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        
        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Santri Diampu</p>
                    <h3 class="text-xl font-medium text-primary-600 mt-1">{{ $santriDiampu }}</h3>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-primary-100 text-primary-600 rounded-full">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Jadwal Hari Ini</p>
                    <h3 class="text-xl font-medium text-blue-600 mt-1">{{ $jadwalHariIni }}</h3>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-blue-100 text-blue-600 rounded-full">
                    <i class="fa-solid fa-calendar text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Presensi Belum Diisi</p>
                    <h3 class="text-xl font-medium text-orange-600 mt-1">{{ $presensiBelumDiisi }}</h3>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-orange-100 text-orange-600 rounded-full">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="p-4 flex justify-between gap-x-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Wajib Evaluasi</p>
                    <h3 class="text-xl font-medium text-red-600 mt-1">{{ $evaluasiBelumDibuat }}</h3>
                </div>
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-red-100 text-red-600 rounded-full">
                    <i class="fa-solid fa-file-lines text-xl"></i>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Data Santri Table -->
    <div class="flex flex-col mb-8">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Santri yang Diampu</h2>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Santri</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($daftarKelasAktif as $kelasItem)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-800">{{ $kelasItem->santri->nama }}</div>
                                        @if($kelasItem->santri->no_hp)
                                            <div class="text-xs text-gray-500">{{ $kelasItem->santri->no_hp }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $kelasItem->hari_jam }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-x-2">
                                            <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-500" role="progressbar" style="width: {{ ($kelasItem->presensis_count / $kelasItem->jumlah_pertemuan) * 100 }}%" aria-valuenow="{{ $kelasItem->presensis_count }}" aria-valuemin="0" aria-valuemax="{{ $kelasItem->jumlah_pertemuan }}"></div>
                                            </div>
                                            <span class="text-xs text-gray-600">{{ $kelasItem->presensis_count }}/{{ $kelasItem->jumlah_pertemuan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($kelasItem->status == 'berjalan')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Sedang Berjalan</span>
                                        @elseif ($kelasItem->status == 'menunggu_evaluasi')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-orange-100 text-orange-800">Menunggu Evaluasi</span>
                                        @elseif ($kelasItem->status == 'selesai')
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        @if ($kelasItem->status == 'berjalan' && $kelasItem->presensis_count < $kelasItem->jumlah_pertemuan)
                                            <a href="{{ route('presensi.create', $kelasItem->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-primary-800 disabled:opacity-50 disabled:pointer-events-none">
                                                Isi Presensi
                                            </a>
                                        @elseif ($kelasItem->status == 'menunggu_evaluasi' || ($kelasItem->status == 'berjalan' && $kelasItem->presensis_count >= $kelasItem->jumlah_pertemuan))
                                            <a href="{{ route('evaluasi.create', $kelasItem->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-orange-600 hover:text-orange-800 disabled:opacity-50 disabled:pointer-events-none">
                                                Isi Evaluasi
                                            </a>
                                        @elseif ($kelasItem->status == 'selesai')
                                            <span class="text-sm text-gray-400">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Tidak ada data santri yang diampu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endunless

    @push('scripts')
        <script>
            const DAYS = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            function pad(n) {
                return String(n).padStart(2, '0');
            }

            function tick() {
                const now = new Date();
                const clock = document.getElementById('live-clock');
                const dateEl = document.getElementById('live-date');
                if(clock) clock.textContent = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
                if(dateEl) dateEl.textContent = DAYS[now.getDay()] + ', ' + now.getDate() + ' ' + MONTHS[now.getMonth()] + ' ' + now.getFullYear();
            }
            tick();
            setInterval(tick, 1000);
        </script>
    @endpush
</x-layouts.app>
