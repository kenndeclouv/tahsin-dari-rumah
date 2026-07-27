<a href="/" {{ $attributes->merge(['class' => 'text-decoration-none text-dark']) }}
    style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
    <img src="{{ asset('assets/logo/tahsindarirumah256.webp') }}" alt="Logo"
        style="height: 1.5rem; width: auto; object-fit: contain;">
    <h3 class="fw-bold mb-0" style="color: inherit; margin: 0; font-size: 1.5rem; font-weight: 700;">
        {{ config('app.name') }}
    </h3>
</a>
