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

    {{-- OG for link previews (Slack, WA, etc.) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('seo.site_name') }}">
    <meta property="og:title" content="{{ $seoPageTitle }}">
    <meta property="og:description" content="{{ config('seo.description') }}">
    <meta property="og:image" content="{{ config('seo.url') . config('seo.og.image') }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    @stack('styles')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        {{-- Sidebar --}}
        <x-sidenav></x-sidenav>
        {{-- Topbar --}}
        <x-topbar></x-topbar>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">

                {{-- Page Title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 text-uppercase fw-bold m-0">{{ $title ?? 'Dashboard' }}</h4>
                            </div>
                            @isset($actions)
                                <div class="mt-2 mt-sm-0">
                                    {{ $actions }}
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>

                {{-- Page Content --}}
                {{ $slot }}

            </div> <!-- end page-container -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content here -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer mt-4">
            <div class="page-container">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <p>
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © {{ config('app.name') }} - By <span
                                class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">{{ config('app.owner') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- END wrapper -->

    {{-- Alert - --}}
    <x-alert></x-alert>

    <!-- Theme Settings -->
    <x-theme-setting></x-theme-setting>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>
