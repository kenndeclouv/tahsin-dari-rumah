<x-layouts.auth title="Lupa Password">
    <h4 class="fw-semibold mb-2">Reset Password</h4>

    <p class="text-muted mb-4">
        Masukkan alamat email kamu, kami akan kirimkan link untuk reset password.
    </p>

    {{-- Status success --}}
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 py-2 text-start">
            <i class="ti ti-circle-check fs-18 flex-shrink-0"></i>
            <span class="fs-13">{{ session('status') }}</span>
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email kamu"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">
                <i class="ti ti-send me-1"></i> Kirim Link Reset
            </button>
        </div>
    </form>

    <p class="text-danger fs-14 mb-4">
        Ingat password? <a href="{{ route('login') }}" class="fw-semibold text-dark ms-1">Login !</a>
    </p>
</x-layouts.auth>
