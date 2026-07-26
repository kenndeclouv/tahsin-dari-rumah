<x-layouts.app title="Rekap Mukafaah">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rekap Mukafaah (Payroll)</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @forelse ($pengajars as $pengajar)
        @php
            $paketBelumLunas = $pengajar->paketBelajars->where('payment_status', 'belum');
            $paketLunas = $pengajar->paketBelajars->where('payment_status', 'lunas');
            
            $totalUangBelumLunas = $paketBelumLunas->sum(function($paket) {
                return $paket->fee ? $paket->fee->nominal : 0;
            });
        @endphp

        <div class="card mb-4 border-primary">
            <div class="card-header border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ $pengajar->photo_url }}" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                    <h5 class="mb-0 fw-bold">{{ $pengajar->name }}</h5>
                </div>
                <div class="text-md-end">
                    <p class="mb-1 text-muted fs-13">Total Tagihan Belum Dibayar</p>
                    <h4 class="mb-0 text-danger fw-bold">Rp {{ number_format($totalUangBelumLunas, 0, ',', '.') }}</h4>
                </div>
            </div>
            
            <div class="card-body pb-0">
                <h6 class="mb-3 text-uppercase text-muted fs-12 fw-bold">Daftar Paket Selesai (Menunggu Pembayaran)</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Santri</th>
                            <th>Jadwal & Pertemuan</th>
                            <th>Fee Paket</th>
                            <th>Status Pembayaran</th>
                            @can('mukafaahs:edit')
                            <th class="text-end">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paketBelumLunas as $paket)
                        <tr>
                            <td class="fw-bold">{{ $paket->santri->nama }}</td>
                            <td>{{ $paket->hari_jam }} ({{ $paket->jumlah_pertemuan }}x)</td>
                            <td>
                                @if($paket->fee)
                                    Rp {{ number_format($paket->fee->nominal, 0, ',', '.') }}
                                @else
                                    <span class="text-muted fst-italic">Tanpa Fee</span>
                                @endif
                            </td>
                            <td><span class="badge bg-danger-subtle text-danger">Belum Lunas</span></td>
                            @can('mukafaahs:edit')
                            <td class="text-end">
                                <form action="{{ route('mukafaah.pay', $paket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Tandai Lunas</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 text-muted">Tidak ada tagihan tertunda.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($paketLunas->count() > 0)
            <div class="card-body pb-0 mt-3 border-top border-dashed">
                <h6 class="mb-3 text-uppercase text-muted fs-12 fw-bold">Riwayat Lunas</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Santri</th>
                            <th>Jadwal & Pertemuan</th>
                            <th>Fee Paket</th>
                            <th>Status Pembayaran</th>
                            @can('mukafaahs:edit')
                            <th class="text-end">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paketLunas as $paket)
                        <tr class="text-muted">
                            <td>{{ $paket->santri->nama }}</td>
                            <td>{{ $paket->hari_jam }} ({{ $paket->jumlah_pertemuan }}x)</td>
                            <td>
                                @if($paket->fee)
                                    Rp {{ number_format($paket->fee->nominal, 0, ',', '.') }}
                                @else
                                    <span class="fst-italic">Tanpa Fee</span>
                                @endif
                            </td>
                            <td><span class="badge bg-success-subtle text-success">Lunas</span></td>
                            @can('mukafaahs:edit')
                            <td class="text-end">
                                <form action="{{ route('mukafaah.pay', $paket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Yakin ingin membatalkan status lunas?')">Batal Lunas</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="ti ti-check text-success display-4 mb-3"></i>
                <h5>Belum ada paket yang selesai</h5>
                <p class="text-muted">Jika pengajar menyelesaikan evaluasi paket santri, data payroll akan muncul di sini.</p>
            </div>
        </div>
    @endforelse
</x-layouts.app>
