<x-layouts.app title="Pengaturan Profil">

    <div class="max-w-6xl flex flex-col lg:flex-row gap-6">

        {{-- ─── LEFT: Avatar card ───────────────────────────────────────────── --}}
        <div class="w-full lg:w-1/3 flex flex-col gap-6">

            {{-- Photo card --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm text-center p-6">
                
                {{-- Avatar --}}
                <div class="relative inline-block mb-4">
                    <img id="avatar-preview" src="{{ auth()->user()->photo_url }}" alt="avatar" class="size-24 rounded-full object-cover border-4 border-primary-500">
                    
                    {{-- Camera badge --}}
                    <label for="photo-input" class="absolute bottom-0 end-0 flex justify-center items-center size-8 bg-primary-600 text-white rounded-full border-2 border-white cursor-pointer hover:bg-primary-700 transition-colors" title="Ganti foto">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                    </label>
                </div>

                <h5 class="text-lg font-bold text-gray-900 mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-sm text-gray-500 mb-4">{{ auth()->user()->email }}</p>

                <div class="flex flex-wrap justify-center gap-2 mb-4">
                    @foreach (auth()->user()->roles as $role)
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary-100 text-primary-800">{{ $role->name }}</span>
                    @endforeach
                </div>

                {{-- Hidden upload form --}}
                <form id="photo-form" action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden" onchange="submitPhotoForm(this)">
                </form>

                {{-- Remove photo --}}
                @if (auth()->user()->photo)
                    <form action="{{ route('profile.photo.remove') }}" method="POST" class="mt-4">
                        @csrf @method('DELETE')
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-200 text-red-600 hover:border-red-600 hover:text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none transition-colors">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            Hapus Foto
                        </button>
                    </form>
                @endif
            </div>

            {{-- Quick info --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
                <p class="text-xs text-gray-500 uppercase font-semibold mb-4">Informasi Akun</p>
                <div class="flex items-center gap-3 mb-4">
                    <svg class="shrink-0 size-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <div>
                        <p class="text-xs text-gray-500">Bergabung</p>
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="shrink-0 size-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                    <div>
                        <p class="text-xs text-gray-500">Role</p>
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->roles->pluck('name')->join(', ') ?: 'Tidak ada' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── RIGHT: Settings forms ───────────────────────────────────────── --}}
        <div class="w-full lg:w-2/3 flex flex-col gap-6">

            {{-- ── General Info ─────────────────────────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                    <svg class="shrink-0 size-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><path d="m19 8 3 3-3 3"/></svg>
                    <h5 class="text-lg font-semibold text-gray-800">Informasi Umum</h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('profile.info') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nama lengkap">
                                @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="alamat@email.com">
                                @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Change Password ──────────────────────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                    <svg class="shrink-0 size-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <h5 class="text-lg font-semibold text-gray-800">Ubah Password</h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Password Saat Ini <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="cur-pass" class="py-3 px-4 pe-11 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Password lama">
                                    <button type="button" onclick="togglePass('cur-pass', 'eye-cur')" class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-primary-600">
                                        <svg id="eye-cur" class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                @error('current_password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Password Baru <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" name="password" id="new-pass" class="py-3 px-4 pe-11 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Min. 8 karakter, huruf & angka">
                                    <button type="button" onclick="togglePass('new-pass', 'eye-new')" class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-primary-600">
                                        <svg id="eye-new" class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                                
                                {{-- Password strength indicator --}}
                                <div class="mt-2 hidden" id="strength-bar-wrap">
                                    <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div id="strength-bar" class="flex flex-col justify-center rounded-full overflow-hidden text-xs text-white text-center whitespace-nowrap transition-all duration-300" style="width: 0%"></div>
                                    </div>
                                    <small id="strength-label" class="text-xs text-gray-500 mt-1 block"></small>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="conf-pass" class="py-3 px-4 pe-11 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Ulangi password baru">
                                    <button type="button" onclick="togglePass('conf-pass', 'eye-conf')" class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-primary-600">
                                        <svg id="eye-conf" class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-3 my-4 flex gap-3 text-sm">
                            <svg class="shrink-0 size-5 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            <div>Password harus minimal 8 karakter dan mengandung huruf serta angka.</div>
                        </div>

                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-amber-500 text-white hover:bg-amber-600 disabled:opacity-50 disabled:pointer-events-none">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Perbarui Password
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── Danger Zone ──────────────────────────────────────────────── --}}
            <div class="bg-red-50 border-2 border-red-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-red-200 flex items-center gap-2">
                    <svg class="shrink-0 size-5 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                    <h5 class="text-lg font-semibold text-red-600">Danger Zone</h5>
                </div>
                <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h6 class="font-semibold text-gray-800 mb-1">Logout dari semua perangkat</h6>
                        <p class="text-sm text-gray-500">Sesi aktif di perangkat lain akan diakhiri.</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-red-200 text-red-600 hover:border-red-600 hover:text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none transition-colors whitespace-nowrap">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        // ── Toggle password visibility ────────────────────────────────────────
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>'; // eye-off svg
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>'; // eye svg
            }
        }

        // ── Avatar instant-preview + auto-submit ─────────────────────────────
        function submitPhotoForm(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('photo-form').submit();
            }
        }

        // ── Password strength checker ─────────────────────────────────────────
        document.getElementById('new-pass').addEventListener('input', function() {
            const val = this.value;
            const wrap = document.getElementById('strength-bar-wrap');
            const bar = document.getElementById('strength-bar');
            const lbl = document.getElementById('strength-label');
            if (!val) {
                wrap.classList.add('hidden');
                return;
            }
            wrap.classList.remove('hidden');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            const levels = [{
                    pct: 25,
                    cls: 'bg-red-500',
                    txt: 'Sangat Lemah'
                },
                {
                    pct: 50,
                    cls: 'bg-amber-500',
                    txt: 'Lemah'
                },
                {
                    pct: 75,
                    cls: 'bg-blue-500',
                    txt: 'Sedang'
                },
                {
                    pct: 100,
                    cls: 'bg-primary-500',
                    txt: 'Kuat'
                },
            ];
            const l = levels[score - 1] || levels[0];
            bar.style.width = l.pct + '%';
            bar.className = 'flex flex-col justify-center rounded-full overflow-hidden text-xs text-white text-center whitespace-nowrap transition-all duration-300 ' + l.cls;
            lbl.textContent = l.txt;
        });
    </script>
    @endpush

</x-layouts.app>
