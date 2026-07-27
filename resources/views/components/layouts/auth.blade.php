@php $authTitle = ($title ?? 'Masuk') . ' | ' . config('seo.site_name'); @endphp
<!DOCTYPE html>
<html lang="{{ config('seo.locale', 'id') }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $authTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('seo.description') }}">
    <meta name="author" content="{{ config('seo.author') }}">
    <meta name="robots" content="{{ config('seo.robots.auth') }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --premium-bg: #f8fafc;
            --premium-surface: #ffffff;
            --premium-primary: #064e3b;
            --premium-secondary: #34d399;
            --premium-text: #0f172a;
            --premium-text-light: #64748b;
        }

        body {
            background-color: var(--premium-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--premium-text);
            margin: 0;
            overflow-x: hidden;
        }
        
        /* Auth Background */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: radial-gradient(circle at top right, rgba(52, 211, 153, 0.1), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(6, 78, 59, 0.05), transparent 40%);
            padding: 2rem 1rem;
        }

        /* Faint Arabic Text in bg */
        .bg-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: clamp(150px, 20vw, 400px);
            color: rgba(6, 78, 59, 0.02);
            font-family: 'Amiri', serif;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
            user-select: none;
        }

        /* Glass / Bento Card */
        .auth-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.04), inset 0 1px 0 rgba(255,255,255,1);
            width: 100%;
            max-width: 440px;
            padding: 3rem 2.5rem;
            position: relative;
            z-index: 10;
        }

        .auth-logo {
            display: inline-block;
            margin-bottom: 2rem;
        }

        /* Custom Inputs */
        .form-control {
            background-color: rgba(248, 250, 252, 0.8) !important;
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
            border-radius: 14px;
            padding: 0.9rem 1.25rem;
            font-size: 0.95rem;
            transition: all 0.2s;
            color: var(--premium-text);
        }
        .form-control:focus {
            background-color: #fff !important;
            border-color: var(--premium-primary) !important;
            box-shadow: 0 0 0 4px rgba(6, 78, 59, 0.1) !important;
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--premium-text);
            margin-bottom: 0.6rem;
        }

        /* Checkbox */
        .custom-checkbox .form-check-input {
            width: 1.1rem;
            height: 1.1rem;
            border-radius: 6px;
            border-color: rgba(0,0,0,0.15);
            cursor: pointer;
        }
        .custom-checkbox .form-check-input:checked {
            background-color: var(--premium-primary);
            border-color: var(--premium-primary);
        }
        .custom-checkbox .form-check-label {
            cursor: pointer;
            padding-top: 2px;
        }

        /* Button Premium */
        .btn-premium {
            background-color: var(--premium-primary);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 0.9rem 1.5rem;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(6, 78, 59, 0.15);
            width: 100%;
        }
        .btn-premium:hover {
            background-color: #04382a;
            box-shadow: 0 12px 24px rgba(6, 78, 59, 0.25);
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <div class="bg-watermark">بِسْمِ اللَّهِ</div>

        <div class="auth-card">
            <div class="auth-logo w-100 text-center">
                <x-logo class="d-inline-flex"></x-logo>
            </div>

            {{ $slot }}

            <p class="mt-4 mb-0 text-center fs-13" style="color: var(--premium-text-light);">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>

    {{-- Alert --}}
    <x-alert></x-alert>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

</body>

</html>
