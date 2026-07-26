<x-layouts.app title="Roles">

    <x-slot:actions>
        @can('roles:create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Tambah Role
            </a>
        @endcan
    </x-slot:actions>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Daftar Role</h4>
                    <span class="badge bg-primary-subtle text-primary">{{ $roles->count() }} Role</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-centered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Role</th>
                                    <th>Guard</th>
                                    <th class="text-center">Jumlah Permission</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td class="text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="fw-semibold">{{ $role->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-secondary-subtle text-secondary">{{ $role->guard_name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-info-subtle text-info">{{ $role->permissions_count }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex gap-1 justify-content-end">
                                                @can('roles:edit')
                                                    <a href="{{ route('roles.permissions', $role) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Atur Permission">
                                                        <i class="ti ti-shield-check me-1"></i> Permissions
                                                    </a>
                                                    <a href="{{ route('roles.edit', $role) }}"
                                                        class="btn btn-sm btn-outline-secondary" title="Edit Role">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('roles:delete')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus Role" data-role-id="{{ $role->id }}"
                                                        data-role-name="{{ $role->name }}" onclick="confirmDelete(this)">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $role->id }}"
                                                        action="{{ route('roles.destroy', $role) }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="ti ti-shield-off fs-24 d-block mb-2"></i>
                                            Belum ada role.
                                            @can('roles:create')
                                                <a href="{{ route('roles.create') }}">Buat sekarang</a>
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
            const id = btn.dataset.roleId;
            const name = btn.dataset.roleName;
            Swal.fire({
                title: 'Hapus Role?',
                text: `Role "${name}" akan dihapus secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--bs-danger)',
                cancelButtonColor: 'var(--bs-secondary)',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</x-layouts.app>
