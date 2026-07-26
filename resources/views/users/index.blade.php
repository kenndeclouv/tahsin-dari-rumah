<x-layouts.app title="Users">

    <x-slot:actions>
        @can('users:create')
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="ti ti-user-plus me-1"></i> Tambah User
            </a>
        @endcan
    </x-slot:actions>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Daftar User</h4>
                    <span class="badge bg-primary-subtle text-primary">{{ $users->count() }} User</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-centered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Bergabung</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                                    style="width: 34px; height: 34px; background: var(--bs-primary); font-size: 13px; flex-shrink: 0;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-semibold">{{ $user->name }}</span>
                                                @if ($user->id === auth()->id())
                                                    <span class="badge bg-warning-subtle text-warning"
                                                        style="font-size: 10px;">Kamu</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-muted">{{ $user->email }}</td>
                                        <td>
                                            @forelse ($user->roles as $role)
                                                <span
                                                    class="badge bg-primary-subtle text-primary me-1">{{ $role->name }}</span>
                                            @empty
                                                <span class="text-muted fs-12">— Tidak ada role</span>
                                            @endforelse
                                        </td>
                                        <td class="text-muted fs-12">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="text-end">
                                            <div class="d-flex gap-1 justify-content-end">
                                                @can('users:edit')
                                                    <a href="{{ route('users.edit', $user) }}"
                                                        class="btn btn-sm btn-outline-secondary" title="Edit User">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('users:delete')
                                                    @if ($user->id !== auth()->id())
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            title="Hapus User" data-user-id="{{ $user->id }}"
                                                            data-user-name="{{ $user->name }}"
                                                            onclick="confirmDelete(this)">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                        <form id="delete-user-{{ $user->id }}"
                                                            action="{{ route('users.destroy', $user) }}" method="POST"
                                                            class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endif
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="ti ti-users-group fs-24 d-block mb-2"></i>
                                            Belum ada user.
                                            @can('users:create')
                                                <a href="{{ route('users.create') }}">Tambah sekarang</a>
                                            @endcan
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

    <script>
        function confirmDelete(btn) {
            const id = btn.dataset.userId;
            const name = btn.dataset.userName;
            Swal.fire({
                title: 'Hapus User?',
                text: `User "${name}" akan dihapus secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--bs-danger)',
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-' + id).submit();
                }
            });
        }
    </script>

</x-layouts.app>
