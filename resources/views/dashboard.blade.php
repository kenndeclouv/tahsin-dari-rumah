<x-layouts.app title="Dashboard">
    <div class="row justify-content-center g-4">
        <div class="col-12 col-md-8">
            {{-- Greeting Card --}}
            <div class="card mb-4 h-100"
                style="background: linear-gradient(135deg, var(--bs-primary) 0%, #1a6b3a 100%); color: #fff; border: none;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ auth()->user()->photo_url }}" width="84" height="84" class="rounded-circle"
                            alt="avatar" style="object-fit: cover; border: 3px solid rgba(255,255,255,0.4)">
                        <div>
                            <p class="mb-0 opacity-75 fs-13">Selamat datang kembali,</p>
                            <h2 class="mb-0 fw-bold">{{ auth()->user()->name }}</h2>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        @foreach (auth()->user()->roles as $role)
                            <span class="badge"
                                style="background: rgba(255,255,255,0.25); font-size: 12px; padding: 6px 12px; border-radius: 20px;">
                                <i class="ti ti-shield-check me-1"></i>{{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Live Clock --}}
        <div class="col-12 col-md-4">
            <div class="card h-100 mb-4">
                <div class="card-body d-flex flex-column text-center align-items-center justify-content-center ">
                    <p class="text-muted mb-1 fs-13 text-uppercase fw-semibold">Waktu Sekarang</p>
                    <div id="live-clock" class="fw-bold mb-1"
                        style="font-size: 4rem; font-variant-numeric: tabular-nums; letter-spacing: 2px; line-height: 1;">
                        --:--:--</div>
                    <p id="live-date" class="text-muted fs-15 mb-0">---</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Ringkasan Metrics --}}
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
    <div class="row g-3 mt-1">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-primary">{{ $pengajarAktif }}</h4>
                            <p class="text-muted mb-0 fs-13">Pengajar Aktif</p>
                        </div>
                        <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-user-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-info">{{ $santriAktif }}</h4>
                            <p class="text-muted mb-0 fs-13">Santri Aktif</p>
                        </div>
                        <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-primary">{{ $jadwalHariIni }}</h4>
                            <p class="text-muted mb-0 fs-13">Jadwal Mengajar Hari Ini</p>
                        </div>
                        <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-secondary">{{ $presensiRatio }}</h4>
                            <p class="text-muted mb-0 fs-13">Presensi Hari Ini</p>
                        </div>
                        <div class="avatar-sm bg-secondary-subtle text-secondary rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-checklist"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-primary">{{ $paketBerjalan }}</h4>
                            <p class="text-muted mb-0 fs-13">Santri Sedang Berjalan</p>
                        </div>
                        <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-run"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-warning">{{ $evaluasiBelumDibuat }}</h4>
                            <p class="text-muted mb-0 fs-13">Menunggu Evaluasi</p>
                        </div>
                        <div class="avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-info">{{ $paketSelesai }}</h4>
                            <p class="text-muted mb-0 fs-13">Selesai Evaluasi</p>
                        </div>
                        <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-file-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-success">{{ $mukafaahSiap }}</h4>
                            <p class="text-muted mb-0 fs-13">Mukafaah Siap Proses</p>
                        </div>
                        <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-coin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row g-3 mt-1">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-primary">{{ $santriDiampu }}</h4>
                            <p class="text-muted mb-0 fs-13">Santri Diampu</p>
                        </div>
                        <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-info">{{ $jadwalHariIni }}</h4>
                            <p class="text-muted mb-0 fs-13">Jadwal Hari Ini</p>
                        </div>
                        <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-warning">{{ $presensiBelumDiisi }}</h4>
                            <p class="text-muted mb-0 fs-13">Presensi Belum Diisi</p>
                        </div>
                        <div class="avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-danger">{{ $evaluasiBelumDibuat }}</h4>
                            <p class="text-muted mb-0 fs-13">Wajib Evaluasi</p>
                        </div>
                        <div class="avatar-sm bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-file-text"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 text-success">{{ $mukafaahDiproses }}</h4>
                            <p class="text-muted mb-0 fs-13">Mukafaah Diproses</p>
                        </div>
                        <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center fs-20">
                            <i class="ti ti-coin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @unless(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin'))
    {{-- Daftar Santri (Paket Belajar) --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h5 class="header-title mb-0">Daftar Santri yang Diampu</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Santri</th>
                                    <th>Hari & Jam</th>
                                    <th>Progress (Presensi)</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarPaketAktif as $paket)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $paket->santri->nama }}</div>
                                            @if($paket->santri->no_hp)
                                                <div class="fs-12 text-muted">{{ $paket->santri->no_hp }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $paket->hari_jam }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                        style="width: {{ ($paket->presensis_count / $paket->jumlah_pertemuan) * 100 }}%;" 
                                                        aria-valuenow="{{ $paket->presensis_count }}" aria-valuemin="0" aria-valuemax="{{ $paket->jumlah_pertemuan }}"></div>
                                                </div>
                                                <span class="fs-12">{{ $paket->presensis_count }}/{{ $paket->jumlah_pertemuan }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($paket->status == 'berjalan')
                                                <span class="badge bg-primary-subtle text-primary">Sedang Berjalan</span>
                                            @elseif ($paket->status == 'menunggu_evaluasi')
                                                <span class="badge bg-warning-subtle text-warning">Menunggu Evaluasi</span>
                                            @elseif ($paket->status == 'selesai')
                                                <span class="badge bg-success-subtle text-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if ($paket->status == 'berjalan' && $paket->presensis_count < $paket->jumlah_pertemuan)
                                                <a href="{{ route('presensi.create', $paket->id) }}" class="btn btn-sm btn-primary">
                                                    Isi Presensi
                                                </a>
                                            @elseif ($paket->status == 'menunggu_evaluasi' || ($paket->status == 'berjalan' && $paket->presensis_count >= $paket->jumlah_pertemuan))
                                                <a href="{{ route('evaluasi.create', $paket->id) }}" class="btn btn-sm btn-warning">
                                                    Isi Evaluasi
                                                </a>
                                            @elseif ($paket->status == 'selesai')
                                                <button class="btn btn-sm btn-light" disabled>Selesai</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
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
    </div>
    @endunless

    @push('scripts')
        <script>
            const DAYS = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ];

            function pad(n) {
                return String(n).padStart(2, '0');
            }

            function tick() {
                const now = new Date();
                document.getElementById('live-clock').textContent = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' +
                    pad(now.getSeconds());
                document.getElementById('live-date').textContent = DAYS[now.getDay()] + ', ' + now.getDate() + ' ' + MONTHS[now
                    .getMonth()] + ' ' + now.getFullYear();
            }
            tick();
            setInterval(tick, 1000);
        </script>
    @endpush
</x-layouts.app>
