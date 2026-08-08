@php
    $seoPageTitle = ($title ?? 'Dashboard') . ' | ' . config('seo.site_name');
@endphp
<!DOCTYPE html>
<html lang="{{ config('seo.locale', 'id') }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $seoPageTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('seo.description') }}">
    <meta name="author" content="{{ config('seo.author') }}">
    <meta name="robots" content="{{ config('seo.robots.admin') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- FontAwesome 7.2.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/all.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>

    {{-- Topbar --}}
    <x-topbar></x-topbar>

    <!-- Content -->
    <div class="w-full pt-4 px-4 sm:px-6 md:px-8 lg:ps-72 hs-overlay-minified:lg:ps-28 transition-all duration-300">

        {{-- Page Header --}}
        <header class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>

            @isset($actions)
                <div class="flex items-center gap-2">
                    {{ $actions }}
                </div>
            @endisset
        </header>

        {{-- Page Content --}}
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-12 py-6 border-t border-gray-200 text-end">
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} {{ config('app.name') }} - By
                <span class="font-semibold uppercase">{{ config('app.owner') }}</span>
            </p>
        </footer>
    </div>
    <!-- End Content -->

    {{-- Alert --}}
    <x-toast></x-toast>

    {{-- Delete Modal --}}
    <x-delete-modal></x-delete-modal>

    {{-- Image Modal --}}
    <x-image-modal></x-image-modal>

    @stack('scripts')
</body>

</html>
