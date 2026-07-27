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

    <!-- FontAwesome 7.2.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/all.css" />

    <!-- Tailwind & Preline -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
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
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <div class="bg-watermark">بِسْمِ اللَّهِ</div>

        <div class="auth-card">
            <div class="w-full text-center inline-flex justify-center mb-8">
                <x-logo></x-logo>
            </div>

            {{ $slot }}

            <p class="mt-8 mb-0 text-center text-sm text-slate-500">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>

    {{-- Alert --}}
    <x-alert></x-alert>

</body>

</html>
