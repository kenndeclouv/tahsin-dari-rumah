<x-layouts.auth title="Buat Password Baru">
    <div class="text-left">
        <h4 class="font-bold text-2xl text-slate-900 mb-2">Buat Password Baru</h4>
        <p class="text-slate-500 mb-6 text-sm">
            Masukkan email dan password baru kamu untuk menyelesaikan proses reset.
        </p>

        <form action="{{ route('password.update') }}" method="POST" class="mb-6">
            @csrf

            {{-- Hidden token from reset link --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-500' }} rounded-xl text-sm bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Masukkan email kamu" value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="password">Password Baru</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="py-3 px-4 pe-11 block w-full border {{ $errors->has('password') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-500' }} rounded-xl text-sm bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Min. 8 karakter" required>
                    <button type="button" class="absolute inset-y-0 end-0 flex items-center px-4 text-gray-500 hover:text-gray-700" onclick="togglePw('password', this)">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="password_confirmation">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="py-3 px-4 pe-11 block w-full border border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl text-sm bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Ulangi password baru" required>
                    <button type="button" class="absolute inset-y-0 end-0 flex items-center px-4 text-gray-500 hover:text-gray-700" onclick="togglePw('password_confirmation', this)">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <div class="grid">
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-xl border border-transparent bg-primary-800 text-white hover:bg-primary-900 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    Simpan Password Baru
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-slate-500">
            Kembali ke 
            <a href="{{ route('login') }}" class="font-bold text-primary-800 hover:text-primary-900 hover:underline ms-1 transition-all">Login !</a>
        </p>

        <script>
            function togglePw(id, btn) {
                const inp = document.getElementById(id);
                const svg = btn.querySelector('svg');
                if (inp.type === 'password') {
                    inp.type = 'text';
                    svg.innerHTML = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>';
                } else {
                    inp.type = 'password';
                    svg.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>';
                }
            }
        </script>
    </div>
</x-layouts.auth>
