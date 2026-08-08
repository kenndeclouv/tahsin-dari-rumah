<x-layouts.app title="Master Data Paket Belajar">
    
    <x-slot:actions>
        @can('paket_belajars:create')
        <a href="{{ route('paket_belajars.create') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Tambah Paket Belajar
        </a>
        @endcan
    </x-slot:actions>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Master Data Paket Belajar (Mukafaah)</h2>
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                            {{ $paketBelajars->count() }} Paket Belajar
                        </span>
                    </div>

                    {{-- Table --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama / Deskripsi Paket</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pertemuan</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nominal (Rp)</th>
                                @canany(['paket_belajars:edit', 'paket_belajars:delete'])
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($paketBelajars as $paketBelajar)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $paketBelajar->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $paketBelajar->nama }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-md text-xs font-medium {{ $paketBelajar->jenis == 'online' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ ucfirst($paketBelajar->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $paketBelajar->jumlah_pertemuan }}x
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        Rp {{ number_format($paketBelajar->nominal, 0, ',', '.') }}
                                    </td>
                                    @canany(['paket_belajars:edit', 'paket_belajars:delete'])
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end">
                                            <x-action-dropdown>
                                                @can('paket_belajars:edit')
                                                    <a href="{{ route('paket_belajars.edit', $paketBelajar->id) }}" class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                        <i class="fa-solid fa-pen-to-square text-gray-400"></i> Edit
                                                    </a>
                                                @endcan
                                                @can('paket_belajars:delete')
                                                    <form action="{{ route('paket_belajars.destroy', $paketBelajar->id) }}" method="POST" class="inline-block w-full" onsubmit="event.preventDefault(); confirmDelete(this, 'Yakin ingin menghapus Paket Belajar ini? Paket Belajar yang terkait akan kehilangan referensi Paket Belajar-nya.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50">
                                                            <i class="fa-solid fa-trash-can text-red-400"></i> Hapus
                                                        </button>
                                                    </form>
                                                @endcan
                                            </x-action-dropdown>
                                        </div>
                                    </td>
                                    @endcanany
                                </tr>
                            @endforeach
                            @if($paketBelajars->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                            <p class="text-gray-500 mb-2">Belum ada master data Paket Belajar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
