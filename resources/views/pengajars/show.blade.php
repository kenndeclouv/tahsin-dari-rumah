<x-layouts.app title="Detail Pengajar - {{ $pengajar->name }}">
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <img src="{{ $pengajar->photo_url }}" width="120" height="120" class="rounded-circle mb-3" style="object-fit: cover; border: 4px solid var(--bs-primary-bg-subtle)">
                    <h4 class="mb-1">{{ $pengajar->name }}</h4>
                    <p class="text-muted">{{ $pengajar->email }}</p>
                    <hr>
                    <div class="text-start">
                        <p class="mb-2"><strong>No HP:</strong> {{ $pengajar->no_hp ?? '-' }}</p>
                        <p class="mb-2"><strong>Jenis Kelamin:</strong> {{ $pengajar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        <p class="mb-2"><strong>Alamat/Domisili:</strong> {{ $pengajar->alamat ?? '-' }}</p>
                        <p class="mb-2"><strong>Status:</strong> 
                            @if($pengajar->status == 'aktif')
                                <span class="badge bg-success-subtle text-success">Aktif</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Nonaktif</span>
                            @endif
                        </p>
                        <p class="mb-2"><strong>Bergabung Sejak:</strong> {{ $pengajar->created_at->format('d M Y') }}</p>
                        @if($pengajar->admin_notes)
                            <hr>
                            <p class="mb-1 fw-bold">Catatan Admin:</p>
                            <p class="mb-0 text-muted fs-13">{{ $pengajar->admin_notes }}</p>
                        @endif
                        
                        @if($customFields->count() > 0)
                            <hr>
                            <h6 class="fs-15 mb-2">Informasi Tambahan</h6>
                            @foreach ($customFields as $field)
                                @php
                                    $val = $pengajar->additional_data[$field->name] ?? '-';
                                @endphp
                                <p class="mb-2"><strong>{{ $field->label }}:</strong> {{ $val }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 mb-4">
            <div class="card h-100">
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
                                    <th>Paket</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paketBelajars as $paket)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $paket->santri->nama }}</div>
                                            @if($paket->santri->no_hp)
                                                <div class="fs-12 text-muted">{{ $paket->santri->no_hp }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $paket->hari_jam }}</td>
                                        <td>{{ $paket->jumlah_pertemuan }}x Pertemuan</td>
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
                                            Pengajar ini belum memiliki santri yang diampu.
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
