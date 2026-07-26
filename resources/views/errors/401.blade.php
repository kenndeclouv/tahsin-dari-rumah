<x-layouts.auth title="401 - Tidak Diotorisasi">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-danger mb-2">401</h1>
        <h4 class="fw-semibold mb-2">Tidak Diotorisasi</h4>
        <p class="text-muted mb-4">Maaf, Anda tidak memiliki akses yang sah untuk melihat halaman ini.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
