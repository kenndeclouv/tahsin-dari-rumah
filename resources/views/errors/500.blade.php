<x-layouts.auth title="500 - Kesalahan Server">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-danger mb-2">500</h1>
        <h4 class="fw-semibold mb-2">Kesalahan Internal Server</h4>
        <p class="text-muted mb-4">Maaf, terjadi kesalahan pada server kami. Silakan coba beberapa saat lagi.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
