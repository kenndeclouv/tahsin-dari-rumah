<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Site Identity
    |--------------------------------------------------------------------------
    */
    'site_name' => env('SEO_SITE_NAME', env('APP_NAME', 'Ust ICAS - Tahsin Privat')),
    'tagline' => env('SEO_TAGLINE', 'Sistem Administrasi Pembelajaran Tahsin Privat'),
    'description' => env('SEO_DESCRIPTION', 'Aplikasi manajemen pengajar Tahsin offline privat. Pantau presensi, evaluasi santri, dan laporan mukafaah dengan mudah.'),
    'keywords' => env('SEO_KEYWORDS', 'tahsin privat, manajemen tahsin, ngaji privat, sistem administrasi pengajar, ust icas'),
    'author' => env('SEO_AUTHOR', env('APP_OWNER', '')),
    'locale' => env('SEO_LOCALE', 'id_ID'),
    'url' => env('SEO_URL', env('APP_URL', '')),

    /*
    |--------------------------------------------------------------------------
    | Open Graph / Social Share
    |--------------------------------------------------------------------------
    */
    'og' => [
        'type' => env('SEO_OG_TYPE', 'website'),
        'image' => env('SEO_OG_IMAGE', '/assets/images/og-image.png'),   // 1200×630
        'twitter' => env('SEO_TWITTER_HANDLE', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Robots
    |--------------------------------------------------------------------------
    | "index, follow"   → normal public pages (landing)
    | "noindex, follow" → auth, dashboard (don't index admin UI)
    */
    'robots' => [
        'public' => env('SEO_ROBOTS_PUBLIC', 'index, follow'),
        'admin' => env('SEO_ROBOTS_ADMIN', 'noindex, follow'),
        'auth' => env('SEO_ROBOTS_AUTH', 'noindex, nofollow'),
    ],

    /*
    |--------------------------------------------------------------------------
    | JSON-LD — Restaurant / Local Business (landing page)
    |--------------------------------------------------------------------------
    */
    'jsonld' => [
        'enabled' => env('SEO_JSONLD_ENABLED', true),
        'type' => env('SEO_JSONLD_TYPE', 'EducationalOrganization'),
        'name' => env('SEO_JSONLD_NAME', env('APP_NAME', 'Ust ICAS - Tahsin Privat')),
        'description' => env('SEO_JSONLD_DESC', 'Lembaga pembelajaran Tahsin offline privat yang berfokus pada kualitas bacaan, makhraj, dan tajwid.'),
        'address' => env('SEO_JSONLD_ADDRESS', 'Indonesia'),
        'telephone' => env('SEO_JSONLD_PHONE', ''),
        'opening_hours' => env('SEO_JSONLD_HOURS', 'Mo-Su 08:00-20:00'),
        'price_range' => env('SEO_JSONLD_PRICE', ''),
        'cuisine' => env('SEO_JSONLD_CUISINE', ''),
        'latitude' => env('SEO_JSONLD_LAT', ''),
        'longitude' => env('SEO_JSONLD_LNG', ''),
    ],
];
