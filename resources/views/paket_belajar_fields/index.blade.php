<x-layouts.app title="Pengaturan Form Paket Belajar">
    
    <x-slot:actions>
        <a href="{{ route('paket_belajar_fields.create') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Tambah Field
        </a>
    </x-slot:actions>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Pengaturan Form Paket Belajar (Dynamic Fields)</h2>
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            {{ $fields->count() }} Field
                        </span>
                    </div>

                    {{-- Table --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Label</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name (DB)</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Required?</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($fields as $field)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $field->order }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $field->label }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <code class="py-1 px-2 bg-gray-100 text-pink-600 rounded-md text-xs font-mono">{{ $field->name }}</code>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-gray-100 text-gray-800">{{ $field->type }}</span>
                                        @if($field->options)
                                            <span class="block text-xs text-gray-500 mt-1">{{ implode(', ', $field->options) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($field->is_required)
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Ya</span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-gray-100 text-gray-600">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-x-2">
                                            <a href="{{ route('paket_belajar_fields.edit', $field->id) }}" class="inline-flex items-center justify-center size-8 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" title="Edit Field">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                            </a>
                                            <form action="{{ route('paket_belajar_fields.destroy', $field->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus field ini? Data lama pada paket belajar tidak akan terhapus namun tidak akan muncul lagi di form.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center size-8 rounded-lg border border-red-200 bg-white text-red-600 shadow-sm hover:bg-red-50 hover:border-red-300 disabled:opacity-50 disabled:pointer-events-none" title="Hapus Field">
                                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
                                            <p class="text-gray-500 mb-2">Belum ada field khusus.</p>
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
</x-layouts.app>
