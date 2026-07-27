<x-layouts.app title="Edit User">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit User — {{ $user->name }}</h2>
                <a href="{{ route('users.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Kembali
                </a>
            </div>
            
            <div class="p-6">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama lengkap" autofocus>
                            @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="email@example.com">
                            @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <p class="text-sm text-gray-500 mb-4">Biarkan kosong jika tidak ingin mengubah password.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium mb-2">Password Baru</label>
                                    <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Minimal 8 karakter">
                                    @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <label class="block text-sm font-medium mb-4">Roles</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($roles as $role)
                                    @php $isChecked = in_array($role->name, old('roles', $userRoles)); @endphp
                                    <label for="role-{{ $role->id }}" class="flex p-4 w-full bg-white border {{ $isChecked ? 'border-primary-500 ring-1 ring-primary-500' : 'border-gray-200' }} rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->name }}" {{ $isChecked ? 'checked' : '' }}>
                                        <span class="ms-3">
                                            <span class="block text-sm font-semibold text-gray-800">{{ $role->name }}</span>
                                            <span class="block text-sm text-gray-500">{{ $role->permissions->count() }} permission</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('users.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
