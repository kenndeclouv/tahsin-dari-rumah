<x-layouts.auth>
    <div class="text-left">
        <h4 class="font-bold text-2xl text-slate-900 mb-1">Selamat Datang Kembali 👋</h4>
        <p class="text-slate-500 mb-6 text-sm">Silakan masuk untuk mengakses panel kendali.</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="nama@email.com" required>
            </div>

            <div class="mb-5">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-semibold text-slate-900" for="password">Password</label>
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800 hover:underline transition-all">Lupa Password?</a>
                </div>
                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Masukkan password Anda" required>
            </div>

            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-emerald-600 focus:ring-emerald-500 size-4 cursor-pointer" id="checkbox-signin" name="remember">
                    <label class="text-sm text-slate-500 ms-3 cursor-pointer" for="checkbox-signin">Ingat saya</label>
                </div>
            </div>

            <div class="grid mb-3">
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-xl border border-transparent bg-emerald-800 text-white hover:bg-emerald-900 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md">
                    Masuk Sekarang
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                </button>
            </div>
        </form>
    </div>
</x-layouts.auth>
