<x-layouts.auth title="Lupa Password">
    <div class="text-left">
        <h4 class="font-bold text-2xl text-slate-900 mb-2">Reset Password</h4>
        <p class="text-slate-500 mb-6 text-sm">
            Masukkan alamat email kamu, kami akan kirimkan link untuk reset password.
        </p>

        {{-- Status success --}}
        @if (session('status'))
            <div class="mb-6 bg-primary-50 border border-primary-200 text-primary-800 rounded-xl p-4 flex items-center gap-3">
                <svg class="shrink-0 size-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span class="text-sm font-medium">{{ session('status') }}</span>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="mb-6">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-900 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-500' }} rounded-xl text-sm bg-slate-50/80 focus:bg-white transition-all shadow-sm" placeholder="Masukkan email kamu" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid">
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-base font-bold rounded-xl border border-transparent bg-primary-800 text-white hover:bg-primary-900 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    Kirim Link Reset
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-slate-500">
            Ingat password?
            <a href="{{ route('login') }}" class="font-bold text-primary-800 hover:text-primary-900 hover:underline ms-1 transition-all">Login di sini!</a>
        </p>
    </div>
</x-layouts.auth>
