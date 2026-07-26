<x-layouts.app title="Kelola Paket Belajar">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h5 class="header-title mb-0">Kelola Paket Belajar</h5>
            @can('paket_belajars:create')
            <a href="{{ route('paket_belajars.create') }}" class="btn btn-primary btn-sm">Buat Paket Baru</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Santri</th>
                            <th>Pengajar</th>
                            <th>Jadwal</th>
                            <th>Target Pertemuan</th>
                            <th>Status</th>
                            @can('paket_belajars:delete')
                            <th class="text-end">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pakets as $paket)
                        <tr>
                            <td class="fw-bold">
                                {{ $paket->santri->nama }}
                                @if(isset($paket->additional_data['nama_paket']))
                                    <div class="fs-12 fw-normal text-muted">{{ $paket->additional_data['nama_paket'] }}</div>
                                @endif
                                @if(isset($paket->additional_data['tipe_kelas']) || isset($paket->additional_data['metode_belajar']))
                                    <div class="fs-12 fw-normal text-muted">
                                        {{ $paket->additional_data['tipe_kelas'] ?? '' }} 
                                        {{ isset($paket->additional_data['metode_belajar']) ? ' - ' . $paket->additional_data['metode_belajar'] : '' }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $paket->pengajar->name }}</td>
                            <td>{{ $paket->hari_jam }}</td>
                            <td>{{ $paket->jumlah_pertemuan }}x</td>
                            <td>
                                @if ($paket->status == 'berjalan')
                                    <span class="badge bg-primary-subtle text-primary">Berjalan</span>
                                @elseif ($paket->status == 'menunggu_evaluasi')
                                    <span class="badge bg-warning-subtle text-warning">Menunggu Evaluasi</span>
                                @elseif ($paket->status == 'selesai')
                                    <span class="badge bg-success-subtle text-success">Selesai</span>
                                @endif
                            </td>
                            @can('paket_belajars:delete')
                                <td class="text-end">
                                    <a href="{{ route('paket_belajars.edit', $paket->id) }}" class="btn btn-sm btn-light">Edit</a>
                                    <form action="{{ route('paket_belajars.destroy', $paket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin menghapus paket ini? Seluruh data presensi dan evaluasi di dalamnya akan ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
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
</x-layouts.app>
