<x-layouts.app title="Master Data Santri">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Master Data Santri</h2>
                        @can('santris:create')
                        <a href="{{ route('santris.create') }}" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none py-2 px-3">
                            <i class="ti ti-plus"></i>
                            Tambah Santri
                        </a>
                        @endcan
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Santri</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Wali</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">No HP Wali</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                @canany(['santris:view', 'santris:edit', 'santris:delete'])
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($santris as $santri)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $santri->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">{{ $santri->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $santri->additional_data['nama_wali'] ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $santri->no_hp }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($santri->status == 'aktif')
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800">Aktif</span>
                                    @elseif($santri->status == 'selesai')
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Selesai</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                                    @endif
                                </td>
                                @canany(['santris:view', 'santris:edit', 'santris:delete'])
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('santris:view')
                                        <a href="{{ route('santris.show', $santri->id) }}" class="inline-flex items-center justify-center size-8 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:bg-blue-100 focus:outline-none focus:bg-blue-100">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @endcan
                                        @can('santris:edit')
                                        <a href="{{ route('santris.edit', $santri->id) }}" class="inline-flex items-center justify-center size-8 text-sm font-semibold rounded-lg border border-transparent text-amber-600 hover:bg-amber-100 focus:outline-none focus:bg-amber-100">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @endcan
                                        @can('santris:delete')
                                        <form action="{{ route('santris.destroy', $santri->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center size-8 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:bg-red-100 focus:outline-none focus:bg-red-100">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                                @endcanany
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data santri.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Table -->

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
