<x-layouts.auth title="403 - Akses Ditolak">
    <div class="mt-4 mb-4 text-center">
        <h1 class="text-7xl font-bold text-orange-500 mb-2">403</h1>
        <h4 class="text-xl font-semibold text-slate-900 mb-2">Akses Ditolak</h4>
        <p class="text-slate-500 mb-6 text-sm">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>

        <div class="grid">
            <a href="{{ route('dashboard') }}" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-xl border border-transparent bg-emerald-800 text-white hover:bg-emerald-900 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md">
                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
