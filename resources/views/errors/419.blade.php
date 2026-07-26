<x-layouts.auth title="419 - Sesi Berakhir">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-warning mb-2">419</h1>
        <h4 class="fw-semibold mb-2">Sesi Kedaluwarsa</h4>
        <p class="text-muted mb-4">Maaf, sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas. Silakan segarkan halaman dan coba lagi.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
