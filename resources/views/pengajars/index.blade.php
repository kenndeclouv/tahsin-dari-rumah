<x-layouts.app title="Master Data Pengajar">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h5 class="header-title mb-0">Master Data Pengajar</h5>
            @can('users:create')
            <a href="{{ route('pengajars.create') }}" class="btn btn-primary btn-sm">Tambah Pengajar</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email / Username</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Bergabung Sejak</th>
                            @canany(['users:view', 'users:edit', 'users:delete'])
                            <th class="text-end">Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajars as $pengajar)
                        <tr>
                            <td class="fw-bold">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $pengajar->photo_url }}" width="32" height="32" class="rounded-circle" style="object-fit: cover;">
                                    {{ $pengajar->name }}
                                </div>
                            </td>
                            <td>{{ $pengajar->email }}</td>
                            <td>{{ $pengajar->no_hp ?? '-' }}</td>
                            <td>
                                @if($pengajar->status == 'aktif')
                                    <span class="badge bg-success-subtle text-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $pengajar->created_at->format('d M Y') }}</td>
                            @canany(['users:view', 'users:edit', 'users:delete'])
                            <td class="text-end">
                                @can('users:view')
                                <a href="{{ route('pengajars.show', $pengajar->id) }}" class="btn btn-sm btn-info text-white">Lihat Santri</a>
                                @endcan
                                @can('users:edit')
                                <a href="{{ route('pengajars.edit', $pengajar->id) }}" class="btn btn-sm btn-light">Edit</a>
                                @endcan
                                @can('users:delete')
                                <form action="{{ route('pengajars.destroy', $pengajar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajar ini? PERHATIAN: Semua Paket Belajar, Presensi, dan Evaluasi yang terkait dengan pengajar ini juga akan terhapus!')">
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
