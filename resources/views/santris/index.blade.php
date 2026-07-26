<x-layouts.app title="Master Data Santri">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h5 class="header-title mb-0">Master Data Santri</h5>
            @can('santris:create')
            <a href="{{ route('santris.create') }}" class="btn btn-primary btn-sm">Tambah Santri</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Santri</th>
                            <th>Nama Wali</th>
                            <th>No HP Wali</th>
                            <th>Status</th>
                            @canany(['santris:view', 'santris:edit', 'santris:delete'])
                            <th class="text-end">Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($santris as $santri)
                        <tr>
                            <td>{{ $santri->id }}</td>
                            <td class="fw-bold">{{ $santri->nama }}</td>
                            <td>{{ $santri->additional_data['nama_wali'] ?? '-' }}</td>
                            <td>{{ $santri->no_hp }}</td>
                            <td>
                                @if($santri->status == 'aktif')
                                    <span class="badge bg-success-subtle text-success">Aktif</span>
                                @elseif($santri->status == 'selesai')
                                    <span class="badge bg-info-subtle text-info">Selesai</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Nonaktif</span>
                                @endif
                            </td>
                            @canany(['santris:view', 'santris:edit', 'santris:delete'])
                            <td class="text-end">
                                @can('santris:view')
                                <a href="{{ route('santris.show', $santri->id) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                @endcan
                                @can('santris:edit')
                                <a href="{{ route('santris.edit', $santri->id) }}" class="btn btn-sm btn-light">Edit</a>
                                @endcan
                                @can('santris:delete')
                                <form action="{{ route('santris.destroy', $santri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                @endcan
                            </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
