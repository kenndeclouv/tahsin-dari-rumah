<x-layouts.app title="Detail Pengajar - {{ $pengajar->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Profile -->
        <div class="flex flex-col gap-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 text-center">
                <div class="relative inline-block mb-4">
                    <img src="{{ $pengajar->photo_url }}" class="inline-block size-32 rounded-full ring-4 ring-primary-100 object-cover" alt="Profile Image">
                    <span class="absolute bottom-1 right-1 block size-4 rounded-full ring-2 ring-white {{ $pengajar->status == 'aktif' ? 'bg-primary-500' : 'bg-red-500' }}"></span>
                </div>
                
                <h4 class="text-xl font-bold text-gray-800 mb-1">{{ $pengajar->name }}</h4>
                <p class="text-sm text-gray-500 mb-4">{{ $pengajar->email }}</p>
                
                <hr class="border-gray-200 my-4">
                
                <div class="text-start space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <strong class="text-gray-800">No HP:</strong> 
                        <span class="text-gray-600">{{ $pengajar->no_hp ?? '-' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <strong class="text-gray-800">Jenis Kelamin:</strong> 
                        <span class="text-gray-600">{{ $pengajar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-start">
                        <strong class="text-gray-800 min-w-max mr-4">Alamat:</strong> 
                        <span class="text-gray-600 text-right">{{ $pengajar->alamat ?? '-' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <strong class="text-gray-800">Status:</strong> 
                        @if($pengajar->status == 'aktif')
                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Aktif</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <strong class="text-gray-800">Bergabung:</strong> 
                        <span class="text-gray-600">{{ $pengajar->created_at->format('d M Y') }}</span>
                    </div>

                    @if($pengajar->admin_notes)
                        <hr class="border-gray-200 my-3">
                        <div>
                            <strong class="block text-gray-800 mb-1">Catatan Admin:</strong>
                            <p class="text-gray-500 italic">{{ $pengajar->admin_notes }}</p>
                        </div>
                    @endif
                    
                    @if($customFields->count() > 0)
                        <hr class="border-gray-200 my-4">
                        <h6 class="text-sm font-semibold text-gray-800 mb-3">Informasi Tambahan:</h6>
                        <div class="space-y-3">
                            @foreach ($customFields as $field)
                                @php
                                    $val = $pengajar->additional_data[$field->name] ?? '-';
                                @endphp
                                <div>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">{{ $field->label }}</span>
                                    <span class="block text-sm font-medium text-gray-800">{{ $val }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content (Daftar Santri) -->
        <div class="lg:col-span-2">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            
                            <!-- Header -->
                            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-gray-800">Daftar Santri yang Diampu</h2>
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $paketBelajars->count() }} Paket
                                </span>
                            </div>
                            
                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Santri</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($paketBelajars as $paket)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-800">{{ $paket->santri->nama }}</div>
                                                @if($paket->santri->no_hp)
                                                    <div class="text-xs text-gray-500">{{ $paket->santri->no_hp }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $paket->hari_jam }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $paket->jumlah_pertemuan }}x Pertemuan
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $percent = $paket->jumlah_pertemuan > 0 ? ($paket->presensis_count / $paket->jumlah_pertemuan) * 100 : 0;
                                                @endphp
                                                <div class="flex items-center gap-x-3">
                                                    <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                                        <div class="flex flex-col justify-center overflow-hidden bg-primary-500" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="{{ $paket->presensis_count }}" aria-valuemin="0" aria-valuemax="{{ $paket->jumlah_pertemuan }}"></div>
                                                    </div>
                                                    <span class="text-xs font-medium text-gray-800">{{ $paket->presensis_count }}/{{ $paket->jumlah_pertemuan }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($paket->status == 'berjalan')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Berjalan</span>
                                                @elseif ($paket->status == 'menunggu_evaluasi')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-orange-100 text-orange-800">Menunggu Evaluasi</span>
                                                @elseif ($paket->status == 'selesai')
                                                    <span class="inline-flex items-center gap-1.5 py-1 px-2 rounded-md text-xs font-medium bg-primary-100 text-primary-800">Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col justify-center items-center">
                                                    <svg class="shrink-0 size-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                    <p class="text-gray-500 mb-2">Pengajar ini belum memiliki santri yang diampu.</p>
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
        </div>
    </div>
</x-layouts.app>
