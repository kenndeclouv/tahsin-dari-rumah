<x-layouts.auth title="Buat Akun">
    <div class="text-left">
        <h4 class="font-bold text-2xl text-slate-900 mb-2">Selamat Datang di {{ config('app.name') }}</h4>
        <p class="text-slate-500 mb-6 text-sm">Masukkan nama, email dan password untuk membuat akun.</p>

        <form action="{{ route('register') }}" method="POST" class="mb-6">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="name">Nama Anda</label>
                <input type="text" id="name" name="name" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="nama@email.com" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="password">Password</label>
                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Minimal 8 karakter" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Ulangi password" required>
            </div>

            <div class="grid">
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-xl border border-transparent bg-emerald-800 text-white hover:bg-emerald-900 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-emerald-800 hover:text-emerald-900 hover:underline ms-1 transition-all">Login di sini!</a>
        </p>
    </div>
</x-layouts.auth>
