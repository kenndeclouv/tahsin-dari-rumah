<x-layouts.auth>
    <h4 class="fw-semibold mb-2">Masuk ke akun anda</h4>

    <p class="text-muted mb-4">Masukkan email dan password anda untuk memesan.</p>

    <form action="{{ route('login') }}" method="POST" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email">
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Masukkan Password">
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                <label class="form-check-label" for="checkbox-signin">Ingat saya</label>
            </div>

            <a href="{{ route('password.request') }}" class="text-muted border-bottom border-dashed">Lupa Password</a>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>

    <p class="text-danger fs-14 mb-4">Tidak punya akun?
        <a href="{{ route('register') }}" class="fw-semibold text-dark ms-1">Buat Sekarang!</a>
    </p>
</x-layouts.auth>
