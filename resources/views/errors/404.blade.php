<x-layouts.auth title="404 - Halaman Tidak Ditemukan">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-primary mb-2">404</h1>
        <h4 class="fw-semibold mb-2">Halaman Tidak Ditemukan</h4>
        <p class="text-muted mb-4">Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
