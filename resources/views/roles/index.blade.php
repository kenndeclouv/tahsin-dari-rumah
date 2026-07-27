<x-layouts.app title="Roles">

    <x-slot:actions>
        @can('roles:create')
            <a href="{{ route('roles.create') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Tambah Role
            </a>
        @endcan
    </x-slot:actions>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Role</h2>
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            {{ $roles->count() }} Role
                        </span>
                    </div>

                    {{-- Table --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Role</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Guard</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah Permission</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($roles as $role)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $role->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-gray-100 text-gray-800">{{ $role->guard_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">{{ $role->permissions_count }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-x-2">
                                            @can('roles:edit')
                                                <a href="{{ route('roles.permissions', $role) }}" class="inline-flex items-center justify-center py-1.5 px-3 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 disabled:opacity-50 disabled:pointer-events-none" title="Atur Permission">
                                                    <svg class="shrink-0 size-4 me-1.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                                    Permissions
                                                </a>
                                                <a href="{{ route('roles.edit', $role) }}" class="inline-flex items-center justify-center size-8 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" title="Edit Role">
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                                </a>
                                            @endcan
                                            @can('roles:delete')
                                                <button type="button" class="inline-flex items-center justify-center size-8 rounded-lg border border-red-200 bg-white text-red-600 shadow-sm hover:bg-red-50 hover:border-red-300 disabled:opacity-50 disabled:pointer-events-none" title="Hapus Role" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}" onclick="confirmDelete(this)">
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                </button>
                                                <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role) }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><line x1="4" x2="20" y1="9" y2="9"/></svg>
                                            <p class="text-gray-500 mb-2">Belum ada role.</p>
                                            @can('roles:create')
                                                <a href="{{ route('roles.create') }}" class="text-emerald-600 hover:text-emerald-800 font-medium text-sm">Buat sekarang</a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(btn) {
            const id = btn.dataset.roleId;
            const name = btn.dataset.roleName;
            Swal.fire({
                title: 'Hapus Role?',
                text: `Role "${name}" akan dihapus secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @endpush

</x-layouts.app>
