<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? config('app.name') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style>
        :root {
            --premium-primary: #064e3b; /* Deep Emerald */
            --premium-secondary: #10b981; /* Vibrant Green */
            --premium-accent: #f59e0b; /* Warm Gold */
            --premium-bg: #fdfbf7; /* Warm Off-white */
            --premium-surface: #ffffff;
            --premium-text: #0f172a;
            --premium-text-muted: #64748b;
            --radius-xl: 32px;
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--premium-bg);
            color: var(--premium-text);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            letter-spacing: -0.03em;
            color: var(--premium-text);
        }

        /* --- Navbar Glassmorphism --- */
        .landing-nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: 100px;
            z-index: 1000;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .landing-nav .btn-primary {
            background-color: var(--premium-primary);
            border: none;
            border-radius: 100px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
        }
        
        .landing-nav .nav-link {
            font-weight: 600;
            color: var(--premium-text);
            padding: 0.5rem 1rem;
            border-radius: 100px;
            transition: background 0.2s;
        }
        .landing-nav .nav-link:hover {
            background: rgba(0,0,0,0.05);
        }

        /* --- Custom Buttons --- */
        .btn-premium {
            background: var(--premium-primary);
            color: white;
            border: none;
            border-radius: 100px;
            padding: 1rem 2.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2);
            position: relative;
            overflow: hidden;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(6, 78, 59, 0.3);
            color: white;
        }
        
        .btn-premium-outline {
            background: transparent;
            color: var(--premium-primary);
            border: 2px solid var(--premium-primary);
            border-radius: 100px;
            padding: 0.85rem 2.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .btn-premium-outline:hover {
            background: var(--premium-primary);
            color: white;
        }

        /* --- Footer --- */
        .landing-footer {
            padding: 4rem 0;
            background: white;
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: 5rem;
        }
        
        /* Layout Fixes */
        .page-content {
            padding-top: 100px; /* Space for fixed nav */
            margin-left: 0 !important; /* Override admin sidebar margin */
            width: 100%;
        }
    </style>

    {{ $head ?? '' }}
</head>

<body>

    <nav class="landing-nav d-flex align-items-center justify-content-between">
        <x-logo class="d-flex align-items-center gap-2" style="color:var(--premium-primary)!important;" />
        <div class="d-none d-md-flex align-items-center gap-1">
            <a href="#kenapa" class="nav-link text-decoration-none">Keunggulan</a>
            <a href="#biaya" class="nav-link text-decoration-none">Paket</a>
            <a href="#testimoni" class="nav-link text-decoration-none">Testimoni</a>
            <a href="#faq" class="nav-link text-decoration-none">FAQ</a>
        </div>
        <div class="d-flex align-items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm" style="border-radius:100px; font-weight:600;">Log In</a>
            @endauth
        </div>
    </nav>

    <div class="page-content">
        {{ $slot }}
    </div>

    <footer class="landing-footer">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <x-logo class="mb-2" />
                    <p class="text-muted fs-14 mb-0">© {{ date('Y') }} {{ config('app.name') }}. Belajar mengaji lebih mudah dan terpercaya.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm" style="border-radius:100px;">
                            <i class="ti ti-dashboard me-1"></i> Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm" style="border-radius:100px; font-weight:600; border:1px solid #e2e8f0;">
                            <i class="ti ti-login me-1"></i> Masuk ke Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    <!-- Alert -->
    <x-alert></x-alert>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    {{ $scripts ?? '' }}
</body>
</html>

