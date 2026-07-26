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

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                    <div class="mb-3">
                        <x-logo></x-logo>
                    </div>

                    {{ $slot }}

                    <p class="mt-3 mb-0">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © {{ config('app.name') }} - By <span
                            class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">{{ config('app.owner') }}</span>
                    </p>

                </div>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    <x-alert></x-alert>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
