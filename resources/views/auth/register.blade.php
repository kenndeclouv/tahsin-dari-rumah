<x-layouts.auth>
    <h4 class="fw-semibold mb-2">Selamat Datang di {{ config('app.name') }}</h4>

    <p class="text-muted mb-4">Masukkan nama, email dan password untuk membuat akun.</p>

    <form action="{{ route('register') }}" method="POST" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="name">Nama Anda</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
        </div>

        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control"
                placeholder="Enter your password">
        </div>

        <div class="mb-3">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                placeholder="Enter your password">
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">Sign Up</button>
        </div>
    </form>

    <p class="text-danger fs-14 mb-4">Sudah punya akun?
        <a href="{{ route('login') }}" class="fw-semibold text-dark ms-1">Login !</a>
    </p>
</x-layouts.auth>
