@php
    $seoTitle = ($title ?? config('seo.site_name')) . ' — ' . config('seo.tagline');
    $seoDesc = $description ?? config('seo.description');
    $seoImage = config('seo.og.image');
    $seoUrl = config('seo.url') . request()->getPathInfo();
    $seoSiteName = config('seo.site_name');
@endphp
<!DOCTYPE html>
<html lang="{{ config('seo.locale', 'id') }}">

<head>
    <meta charset="utf-8" />
    {{-- ── Primary Meta ──────────────────────────────────────────────────── --}}
    <title>{{ $seoTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="{{ config('seo.keywords') }}">
    <meta name="author" content="{{ config('seo.author') }}">
    <meta name="robots" content="{{ config('seo.robots.public') }}">
    <link rel="canonical" href="{{ $seoUrl }}">

    {{-- ── Open Graph ────────────────────────────────────────────────────── --}}
    <meta property="og:type" content="{{ config('seo.og.type') }}">
    <meta property="og:site_name" content="{{ $seoSiteName }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:image" content="{{ config('seo.url') . $seoImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height"content="630">
    <meta property="og:locale" content="{{ config('seo.locale') }}">

    {{-- ── Twitter Card ──────────────────────────────────────────────────── --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ config('seo.url') . $seoImage }}">
    @if (config('seo.og.twitter'))
        <meta name="twitter:site" content="{{ config('seo.og.twitter') }}">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config (loads theme preference before CSS flash) -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* ── Landing-specific overrides ───────────────────────────────────────── */
        html,
        body {
            scroll-behavior: smooth;
        }

        .landing-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            background: rgba(var(--bs-body-bg-rgb, 255, 255, 255), 0.85);
            border-bottom: 2px solid var(--bs-border-color);
            padding: 0.75rem 0;
        }

        .landing-hero {
            min-height: 100vh;
            padding-top: 80px;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--bs-body-bg) 0%, rgba(var(--bs-primary-rgb), .08) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-graphic {
            position: absolute;
            right: -60px;
            top: 50%;
            transform: translateY(-50%);
            width: 520px;
            height: 520px;
            border-radius: 50%;
            background: radial-gradient(circle at center, rgba(var(--bs-primary-rgb), .18) 0%, transparent 70%);
            pointer-events: none;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            display: block;
            height: 4px;
            width: 48px;
            background: var(--bs-primary);
            border-radius: 2px;
            margin-top: 6px;
        }

        .feature-card {
            border: 2px solid var(--bs-border-color);
            border-radius: 12px;
            padding: 1.75rem;
            transition: transform .2s, box-shadow .2s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 6px 6px 0 var(--bs-primary);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: rgba(var(--bs-primary-rgb), .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--bs-primary);
            margin-bottom: 1rem;
        }

        .product-card {
            border: 2px solid var(--bs-border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 4px 4px 0 var(--bs-border-color);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), .08), rgba(var(--bs-primary-rgb), .18));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: rgba(var(--bs-primary-rgb), .4);
        }

        .stat-card {
            border: 2px solid var(--bs-border-color);
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .landing-footer {
            border-top: 2px solid var(--bs-border-color);
            padding: 2rem 0;
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: .06;
            pointer-events: none;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--bs-primary);
            top: 10%;
            left: -80px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--bs-info);
            bottom: 15%;
            right: -50px;
        }
    </style>

    {{ $head ?? '' }}

    {{-- ── JSON-LD Structured Data (Restaurant / LocalBusiness) ──────────── --}}
    @if (config('seo.jsonld.enabled'))
        @php
            $jsonLd = [
                '@context' => 'https://schema.org',
                '@type' => config('seo.jsonld.type'),
                'name' => config('seo.jsonld.name'),
                'description' => config('seo.jsonld.desc'),
                'url' => config('seo.url'),
                'telephone' => config('seo.jsonld.telephone'),
                'priceRange' => config('seo.jsonld.price_range'),
                'servesCuisine' => config('seo.jsonld.cuisine'),
                'openingHours' => config('seo.jsonld.opening_hours'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => config('seo.jsonld.address'),
                    'addressCountry' => 'ID',
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => (float) config('seo.jsonld.latitude'),
                    'longitude' => (float) config('seo.jsonld.longitude'),
                ],
                'image' => config('seo.url') . config('seo.og.image'),
                'sameAs' => [],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
    @endif
</head>

<body>

    <!-- ─── Navbar ──────────────────────────────────────────────────────────── -->
    <nav class="landing-nav">
        <div class="container-xl d-flex align-items-center justify-content-between">
            <x-logo></x-logo>
            <div class="d-flex align-items-center gap-3">
                <a href="#kenapa" class="text-body text-decoration-none fw-semibold d-none d-md-inline">Kenapa</a>
                <a href="#menu" class="text-body text-decoration-none fw-semibold d-none d-md-inline">Menu</a>
                <a href="#testimoni" class="text-body text-decoration-none fw-semibold d-none d-md-inline">Testimoni</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-dashboard me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Masuk</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ─── Page Content ────────────────────────────────────────────────────── -->
    {{ $slot }}

    <!-- ─── Footer ──────────────────────────────────────────────────────────── -->
    <footer class="landing-footer">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <x-logo></x-logo>
                    <p class="text-muted fs-12 mb-0">© {{ date('Y') }} {{ config('app.name') }}. Dibuat oleh
                        {{ config('app.owner') }}.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-dashboard me-1"></i> Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-login me-1"></i> Masuk ke Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    <!-- Alert -->
    <x-alert></x-alert>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{ $scripts ?? '' }}

</body>

</html>
