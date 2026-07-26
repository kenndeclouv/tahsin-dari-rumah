<x-layouts.auth title="Buat Password Baru">
    <h4 class="fw-semibold mb-2">Buat Password Baru</h4>

    <p class="text-muted mb-4">
        Masukkan email dan password baru kamu untuk menyelesaikan proses reset.
    </p>

    <form action="{{ route('password.update') }}" method="POST" class="text-start mb-3">
        @csrf

        {{-- Hidden token from reset link --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email kamu"
                value="{{ old('email', $request->email) }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password Baru</label>
            <div class="input-group">
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 karakter" required>
                <button type="button" class="btn btn-outline-secondary input-group-text px-3"
                    onclick="togglePw('password', this)">
                    <i class="ti ti-eye" id="password-eye"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Ulangi password baru" required>
                <button type="button" class="btn btn-outline-secondary input-group-text px-3"
                    onclick="togglePw('password_confirmation', this)">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">
                <i class="ti ti-lock-check me-1"></i> Simpan Password Baru
            </button>
        </div>
    </form>

    <p class="text-danger fs-14 mb-4">
        Kembali ke <a href="{{ route('login') }}" class="fw-semibold text-dark ms-1">Login !</a>
    </p>

    <script>
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (inp.type === 'password') {
                inp.type = 'text';
                icon.className = 'ti ti-eye-off';
            } else {
                inp.type = 'password';
                icon.className = 'ti ti-eye';
            }
        }
    </script>
</x-layouts.auth>
