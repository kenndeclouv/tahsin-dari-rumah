<x-layouts.app title="Detail Santri - {{ $santri->nama }}">
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="avatar-lg bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 fs-24 fw-bold">
                        {{ substr($santri->nama, 0, 1) }}
                    </div>
                    <h4 class="mb-1">{{ $santri->nama }}</h4>
                    <p class="text-muted">{{ $santri->no_hp }}</p>
                    <hr>
                    <div class="text-start">
                        <p class="mb-2"><strong>Status:</strong> 
                            @if($santri->status == 'aktif')
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            @elseif($santri->status == 'selesai')
                                <span class="badge bg-info-subtle text-info">Selesai</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Nonaktif</span>
                            @endif
                        </p>
                        
                        <h6 class="fs-14 mt-4 mb-2">Informasi Tambahan:</h6>
                        @if($santri->additional_data)
                            @foreach($santri->additional_data as $key => $value)
                                @php
                                    $label = ucwords(str_replace('_', ' ', $key));
                                @endphp
                                <p class="mb-2"><strong>{{ $label }}:</strong> {{ $value ?: '-' }}</p>
                            @endforeach
                        @else
                            <p class="text-muted fs-13">Belum ada informasi tambahan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h5 class="header-title mb-0">Riwayat Paket Belajar</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Pengajar</th>
                                    <th>Jadwal (Hari & Jam)</th>
                                    <th>Durasi / Pertemuan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Status Paket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paketBelajars as $paket)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $paket->pengajar->name ?? '-' }}</div>
                                        </td>
                                        <td>{{ $paket->hari_jam }}</td>
                                        <td>{{ $paket->jumlah_pertemuan }}x Pertemuan</td>
                                        <td>{{ $paket->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($paket->status == 'berjalan')
                                                <span class="badge bg-primary-subtle text-primary">Berjalan</span>
                                            @elseif ($paket->status == 'menunggu_evaluasi')
                                                <span class="badge bg-warning-subtle text-warning">Menunggu Evaluasi</span>
                                            @elseif ($paket->status == 'selesai')
                                                <span class="badge bg-success-subtle text-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Santri ini belum memiliki paket belajar.
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
</x-layouts.app>
