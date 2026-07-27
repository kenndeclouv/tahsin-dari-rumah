<x-layouts.app title="Tambah User">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Buat User Baru</h2>
                <a href="{{ route('users.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Kembali
                </a>
            </div>
            
            <div class="p-6">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama lengkap" autofocus>
                            @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="email@example.com">
                            @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium mb-2">Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Minimal 8 karakter">
                            @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ulangi password">
                        </div>

                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <label class="block text-sm font-medium mb-4">Roles</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($roles as $role)
                                    @php $isChecked = in_array($role->name, old('roles', [])); @endphp
                                    <label for="role-{{ $role->id }}" class="flex p-4 w-full bg-white border {{ $isChecked ? 'border-emerald-500 ring-1 ring-emerald-500' : 'border-gray-200' }} rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-emerald-600 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->name }}" {{ $isChecked ? 'checked' : '' }}>
                                        <span class="ms-3">
                                            <span class="block text-sm font-semibold text-gray-800">{{ $role->name }}</span>
                                            <span class="block text-sm text-gray-500">{{ $role->permissions->count() }} permission</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @if ($roles->isEmpty())
                                <p class="text-sm text-gray-500 mt-2">Belum ada role. <a href="{{ route('roles.create') }}" class="text-emerald-600 hover:underline">Buat role</a> terlebih dahulu.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('users.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
