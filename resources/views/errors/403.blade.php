<x-layouts.auth title="403 - Akses Ditolak">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-danger mb-2">403</h1>
        <h4 class="fw-semibold mb-2">Akses Ditolak</h4>
        <p class="text-muted mb-4">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
