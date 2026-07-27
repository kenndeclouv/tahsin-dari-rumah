<x-layouts.auth>
    <div class="text-start">
        <h4 class="fw-bold mb-1" style="color: var(--premium-text);">Selamat Datang Kembali 👋</h4>
        <p class="text-muted mb-4 fs-14" style="color: var(--premium-text-light);">Silakan masuk untuk mengakses panel kendali.</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label mb-0" for="password">Password</label>
                    <a href="{{ route('password.request') }}" class="text-decoration-none fs-13" style="color: var(--premium-primary); font-weight: 600;">Lupa Password?</a>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>

            <div class="mb-4">
                <div class="form-check custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                    <label class="form-check-label fs-14 ms-1" style="color: var(--premium-text-light);" for="checkbox-signin">Ingat saya</label>
                </div>
            </div>

            <div class="d-grid mb-3">
                <button class="btn-premium d-flex justify-content-center align-items-center gap-2" type="submit">
                    Masuk Sekarang <i class="ti ti-login fs-18"></i>
                </button>
            </div>
        </form>
    </div>
</x-layouts.auth>
