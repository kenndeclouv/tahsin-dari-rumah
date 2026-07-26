<x-layouts.auth title="429 - Terlalu Banyak Permintaan">
    <div class="mt-4 mb-4">
        <h1 class="display-3 fw-bold text-warning mb-2">429</h1>
        <h4 class="fw-semibold mb-2">Terlalu Banyak Permintaan</h4>
        <p class="text-muted mb-4">Maaf, Anda melakukan terlalu banyak tindakan berturut-turut. Silakan tunggu beberapa saat lagi sebelum mencoba kembali.</p>

        <div class="d-grid">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-layouts.auth>
