<x-layouts.landing title="{{ config('app.name') }} - Belajar Mengaji Online untuk Anak & Dewasa">
    <x-slot name="head">
        <style>
            /* --- Hero Section --- */
            .hero-section {
                padding: 8rem 0 6rem;
                position: relative;
                overflow: visible;
            }
            .hero-mesh {
                position: absolute;
                top: -20%;
                left: 50%;
                transform: translateX(-50%);
                width: 100vw;
                height: 1000px;
                background: 
                    radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 80% 40%, rgba(6, 78, 59, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 50% 10%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
                z-index: 0;
                pointer-events: none;
            }

            /* --- Marquee --- */
            .hero-marquee-container {
                position: absolute;
                bottom: 40px;
                left: 50%;
                width: 110vw;
                overflow: hidden;
                background: var(--premium-primary);
                padding: 15px 0;
                z-index: 0;
                transform: translateX(-50%) rotate(-1.5deg);
                transform-origin: center;
            }
            .hero-marquee {
                display: flex;
                white-space: nowrap;
                animation: marquee 25s linear infinite;
            }
            .hero-marquee span {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 700;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-right: 30px;
                display: inline-flex;
                align-items: center;
                gap: 30px;
            }
            .hero-marquee span::after {
                content: '✦';
                color: var(--premium-secondary);
                font-size: 0.8rem;
            }
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }

            .hero-gradient-text {
                background: linear-gradient(135deg, var(--primary-700) 0%, var(--primary-300) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
            }
            .glass-badge {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.9);
                border-radius: 100px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            }
            
            /* --- Bento Grid (Keunggulan) --- */
            .bento-card {
                background: white;
                border: 1px solid rgba(0,0,0,0.03);
                border-radius: var(--radius-lg);
                padding: 2.5rem;
                height: 100%;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            }
            .bento-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.06);
            }
            .bento-icon-wrapper {
                width: 60px;
                height: 60px;
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 28px;
                margin-bottom: 1.5rem;
            }
            .bento-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            @media (min-width: 768px) {
                .bento-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            @media (min-width: 992px) {
                .bento-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
                .bento-large { grid-column: span 2; }
            }

            /* --- Pricing --- */
            .price-card {
                background: white;
                border: 1px solid rgba(0,0,0,0.05);
                border-radius: var(--radius-xl);
                padding: 3rem 2rem;
                height: 100%;
                position: relative;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0,0,0,0.02);
                transition: transform 0.3s ease;
            }
            .price-card:hover {
                transform: translateY(-10px);
            }
            .price-card.featured {
                background: var(--premium-primary);
                color: white;
                box-shadow: 0 20px 40px rgba(6,78,59,0.2);
                border: none;
            }
            
            /* --- Testimonial Marquee --- */
            .marquee-wrapper {
                overflow: hidden;
                padding: 2rem 0;
                width: 100vw;
                position: relative;
                left: 50%;
                right: 50%;
                margin-left: -50vw;
                margin-right: -50vw;
                background: rgba(255,255,255,0.5);
            }
            .marquee-track {
                display: flex;
                gap: 2rem;
                width: max-content;
                animation: scroll 40s linear infinite;
            }
            .marquee-track:hover {
                animation-play-state: paused;
            }
            @keyframes scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-50% - 1rem)); }
            }
            .testi-card {
                width: 400px;
                background: white;
                border-radius: var(--radius-lg);
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.03);
                border: 1px solid rgba(0,0,0,0.03);
                white-space: normal;
            }

            /* --- Accordion FAQ --- */
            .faq-accordion .accordion-item {
                border: none;
                background: white;
                border-radius: var(--radius-md) !important;
                margin-bottom: 1rem;
                box-shadow: 0 5px 15px rgba(0,0,0,0.02);
                overflow: hidden;
            }
            .faq-accordion .accordion-button {
                padding: 1.5rem;
                font-weight: 700;
                font-size: 1.1rem;
                background: transparent;
                box-shadow: none !important;
                color: var(--premium-text);
            }
            .faq-accordion .accordion-button:not(.collapsed) {
                color: var(--premium-primary);
                background: rgba(16,185,129,0.05);
            }

            /* --- CTA Banner --- */
            .cta-banner {
                background: linear-gradient(135deg, var(--primary-800) 0%, var(--primary-600) 100%);
                border-radius: var(--radius-xl);
                padding: 5rem 3rem;
                position: relative;
                overflow: hidden;
            }
            .cta-circle {
                position: absolute;
                border-radius: 50%;
                background: rgba(255,255,255,0.03);
            }
        </style>
    </x-slot>

    {{-- ─── HERO ──────────────────────────────────────────────────────────── --}}
    <section class="hero-section text-center">
        <div class="hero-mesh"></div>
        <div class="container-xl position-relative z-1">
            {{-- <div class="hero-badge d-inline-flex align-items-center gap-2 px-4 py-2 glass-badge mb-4">
                <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width:24px; height:24px; font-size:12px;">
                    <i class="fa-solid fa-star shrink-0 size-5"></i>
                </div>
                <span class="fw-semibold fs-14" style="color:var(--premium-primary)">1200+ Murid Belajar Bersama Kami</span>
            </div> --}}
            
            <h1 class="mt-5 pt-2 hero-h1 display-3 fw-black mb-4 mx-auto" style="max-width: 900px; line-height: 1.15;">
                Belajar Mengaji Online/Offline <br>
                <span class="hero-gradient-text" id="typewriter"></span>
            </h1>
            
            <p class="hero-subtitle fs-18 mb-5 mx-auto text-muted" style="max-width: 600px; line-height: 1.6;">
                Kini belajar ngaji lebih mudah dan menyenangkan bersama asatidz {{ config('app.name') }} yang sabar dan profesional.
            </p>
            
            <div class="hero-cta d-flex flex-column flex-sm-row justify-content-center gap-3 mb-5">
                <a href="https://wa.me/628123456789" class="btn-premium text-decoration-none">
                    <i class="fa-solid fa-play shrink-0 size-5"></i> Belajar Sekarang
                </a>
                <a href="#biaya" class="btn-premium-outline text-decoration-none">
                    Lihat Pilihan Paket
                </a>
            </div>

            {{-- <div class="hero-stats d-flex flex-wrap justify-content-center gap-4 pt-4 border-top" style="border-color: rgba(0,0,0,0.05)!important; max-width:800px; margin:0 auto;">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-users fs-24 text-success"></i>
                    <span class="fw-semibold text-muted"><span class="count-up" data-target="90">0</span>+ Guru Tersertifikasi</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-certificate fs-24 text-primary"></i>
                    <span class="fw-semibold text-muted"><span class="count-up" data-target="2500">0</span>+ Alumni</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-thumbs-up fs-24 text-warning"></i>
                    <span class="fw-semibold text-muted"><span class="count-up" data-target="99">0</span>% Kepuasan</span>
                </div>
            </div> --}}
        </div>

        <!-- Marquee Tape -->
        <div class="hero-marquee-container">
            <div class="hero-marquee">
                <!-- Text repeated twice for smooth infinite scroll (50% translation) -->
                <span>BELAJAR MENGAJI ONLINE</span><span>TAHSIN & TAHFIDZ</span><span>GURU TERSERTIFIKASI</span><span>KAPAN SAJA</span><span>DIMANA SAJA</span>
                <span>BELAJAR MENGAJI ONLINE</span><span>TAHSIN & TAHFIDZ</span><span>GURU TERSERTIFIKASI</span><span>KAPAN SAJA</span><span>DIMANA SAJA</span>
                <span>BELAJAR MENGAJI ONLINE</span><span>TAHSIN & TAHFIDZ</span><span>GURU TERSERTIFIKASI</span><span>KAPAN SAJA</span><span>DIMANA SAJA</span>
                <span>BELAJAR MENGAJI ONLINE</span><span>TAHSIN & TAHFIDZ</span><span>GURU TERSERTIFIKASI</span><span>KAPAN SAJA</span><span>DIMANA SAJA</span>
            </div>
        </div>
    </section>

    {{-- ─── BENTO GRID: KEUNGGULAN ─────────────────────────────────────────── --}}
    <section class="py-5" id="kenapa">
        <div class="container-xl">
            <div class="text-center mb-5 reveal-up">
                <h6 class="fw-bold" style="color:var(--premium-secondary); text-transform:uppercase; letter-spacing:1px;">Mengapa {{ config('app.name') }}?</h6>
                <h2 class="display-6 fw-black">Cocok buat kamu yang ingin lancar<br>baca Al-Quran, anak-anak maupun dewasa</h2>
                <span class="line-draw"></span>
            </div>

            <div class="bento-grid">
                
                {{-- 1. Private --}}
                <div class="bento-card bento-large position-relative overflow-hidden reveal-scale" style="background:var(--premium-primary); color:white;">
                    <div style="position:absolute; right:-50px; bottom:-50px; font-size:200px; opacity:0.1; line-height:1;">👤</div>
                    <div class="bento-icon-wrapper" style="background:rgba(255,255,255,0.15); color:white;">
                        <i class="fa-solid fa-user-check shrink-0 size-5"></i>
                    </div>
                    <h3 class="fw-bold mb-3 text-white">Belajarnya Private 1 on 1</h3>
                    <p class="fs-16 mb-0" style="opacity:0.9; max-width:400px;">Malu kalau belum bisa? Atau ingin lebih fokus? Private 1 on 1 aja di {{ config('app.name') }}. Anda mendapat perhatian penuh dari pengajar.</p>
                </div>

                {{-- 2. Jadwal Fleksibel --}}
                <div class="bento-card reveal-up" style="transition-delay:0.1s">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-secondary) 15%, transparent); color:var(--premium-secondary);">
                        <i class="fa-solid fa-clock shrink-0 size-5"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Jadwal Fleksibel</h4>
                    <p class="text-muted mb-0">Pilih jadwal sendiri, dari pagi sampai malam, weekdays atau weekend bebas atur waktu luang Anda.</p>
                </div>

                {{-- 3. Sabar & Profesional --}}
                <div class="bento-card reveal-up" style="transition-delay:0.2s">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-primary) 12%, transparent); color:var(--premium-primary);">
                        <i class="fa-solid fa-award shrink-0 size-5"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Sabar & Profesional</h4>
                    <p class="text-muted mb-0">Alumni kampus/pesantren ternama & sudah tersertifikasi. Kami concern dengan kualitas pengajaran.</p>
                </div>

                {{-- 4. Bisa Request Materi --}}
                <div class="bento-card bento-large position-relative overflow-hidden reveal-scale" style="background:var(--premium-primary); color:white;">
                    <div style="position:absolute; right:-50px; bottom:-50px; font-size:200px; opacity:0.1; line-height:1;">📚</div>
                    <div class="row align-items-center h-100 position-relative z-1">
                        <div class="col-md-7">
                            <div class="bento-icon-wrapper" style="background:rgba(255,255,255,0.15); color:white;">
                                <i class="fa-solid fa-book shrink-0 size-5"></i>
                            </div>
                            <h4 class="fw-bold mb-3 text-white">Bisa Request Materi Bebas</h4>
                            <p class="mb-0" style="opacity:0.9;">Mulai dasar, makhraj, tajwid, hafalan, fiqih, sirah nabi, atau memahami makna ayat - semua bisa di {{ config('app.name') }} sesuai request.</p>
                        </div>
                    </div>
                </div>

                {{-- 5. Laporan & Evaluasi --}}
                <div class="bento-card">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-primary) 12%, transparent); color:var(--premium-primary);">
                        <i class="fa-solid fa-chart-line shrink-0 size-5"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Laporan per Pertemuan</h4>
                    <p class="text-muted mb-0">Pantau progress belajarnya melalui aplikasi, jadi bahan evaluasi & sekaligus penyemangat diri.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- ─── HARGA PAKET ──────────────────────────────────────────────────────── --}}
    <section class="py-5" id="biaya">
        <div class="container-xl py-4">
            <div class="text-center mb-5 reveal-up"><h6 class="fw-bold" style="color:var(--premium-secondary); text-transform:uppercase; letter-spacing:1px;">Biaya Fleksibel</h6>
                <h2 class="display-6 fw-black">Harga paket investasi belajar Al-Quran</h2>
                <p class="text-muted mt-3 mx-auto" style="max-width:520px;">Apapun paketnya, kualitas tetap yang utama dengan guru bersertifikat.</p>
            </div>

            <div class="row g-2 align-items-center justify-content-center stagger-parent">
                @php
                    $pakets = [
                        ['Paket 1', '300.000', '4x', '1x', false],
                        ['Paket 2', '600.000', '8x', '2x', false],
                        ['Paket 3', '800.000', '12x', '3x', true],
                        ['Paket 4', '1.300.000', '20x', 'Minimal 4x', false]
                    ];
                @endphp

                @foreach ($pakets as [$nama, $harga, $pertemuan, $jadwal, $isFeatured])
                    <div class="col-md-6 col-lg-3">
                        <div class="price-card {{ $isFeatured ? 'featured' : '' }}">
                            @if($isFeatured)
                                <span class="position-absolute badge bg-warning text-dark fw-bold px-3 py-1" style="top:20px; right:20px; border-radius:100px;">Terpopuler</span>
                            @endif
                            <h5 class="fw-bold mb-2 {{ $isFeatured ? 'text-white' : 'text-muted' }}">{{ $nama }}</h5>
                            <div class="d-flex align-items-start mb-4">
                                <span class="fs-20 fw-bold me-1 mt-1">Rp</span>
                                <span class="fw-black" style="font-size: 2.5rem; line-height:1;">{{ $harga }}</span>
                            </div>
                            
                            <ul class="list-unstyled mb-5">
                                <li class="mb-3 d-flex"><i class="fa-solid fa-check fs-18 me-2 {{ $isFeatured ? 'text-warning' : 'text-success' }}"></i> <span><strong>{{ $pertemuan }} Pertemuan</strong> Mengaji</span></li>
                                <li class="mb-3 d-flex"><i class="fa-solid fa-check fs-18 me-2 {{ $isFeatured ? 'text-warning' : 'text-success' }}"></i> <span>Jadwal <strong>{{ $jadwal }} Tiap Pekan</strong></span></li>
                                <li class="mb-3 d-flex"><i class="fa-solid fa-check fs-18 me-2 {{ $isFeatured ? 'text-warning' : 'text-success' }}"></i> <span>60 Menit Per Sesi</span></li>
                                <li class="mb-3 d-flex"><i class="fa-solid fa-check fs-18 me-2 {{ $isFeatured ? 'text-warning' : 'text-success' }}"></i> <span>Privat 1 Murid 1 Guru</span></li>
                                <li class="mb-0 d-flex"><i class="fa-solid fa-check fs-18 me-2 {{ $isFeatured ? 'text-warning' : 'text-success' }}"></i> <span>Free Materi Mengaji</span></li>
                            </ul>
                            
                            <a href="https://wa.me/628123456789" class="btn w-100 py-3 fw-bold {{ $isFeatured ? 'btn-light text-success' : 'btn-outline-dark' }}" style="border-radius:100px;">
                                Pilih Paket Ini
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── PENGAJAR & SERTIFIKASI ────────────────────────────────────────────── --}}
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container-xl py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <h6 class="fw-bold" style="color:var(--premium-secondary); text-transform:uppercase; letter-spacing:1px;">Kualitas Pengajar</h6>
                    <h2 class="display-6 fw-black mb-4">Pengajar lulusan pesantren dan tersertifikasi</h2>
                    <p class="text-muted fs-16 mb-4">Kami memastikan bahwa setiap guru yang mengajar di {{ config('app.name') }} memiliki kapabilitas dan standar mutu yang diakui oleh lembaga pendidikan nasional maupun yayasan metode baca Al-Quran ternama.</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        @foreach ([
                            ['Iqro', 'Pelopor cara cepat membaca Al-Quran oleh KH. As\'ad Humam', 'ti-book-2'],
                            ['BNSP', 'Lembaga resmi pemerintah untuk menjamin mutu dan kompetensi', 'ti-certificate'],
                            ['Ummi Foundation', 'Pendidikan untuk peningkatan kualitas Guru Al-Qur\'an', 'ti-school'],
                            ['Pondok Al Karomah', 'Fokus hafalan, tafsir dan pembelajaran Al-Qur\'an', 'ti-building-mosque']
                        ] as [$title, $desc, $icon])
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border bg-light h-100" style="border-color: rgba(0,0,0,0.03)!important;">
                                    <i class="ti {{ $icon }} fs-3 mb-3 d-block" style="color:var(--premium-primary)"></i>
                                    <h5 class="fw-bold mb-2">{{ $title }}</h5>
                                    <p class="text-muted fs-13 mb-0">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── TESTIMONI MARQUEE ─────────────────────────────────────────────────── --}}
    <section class="py-5 overflow-hidden" id="testimoni">
        <div class="container-xl text-center mb-4">
            <h6 class="fw-bold" style="color:var(--premium-secondary); text-transform:uppercase; letter-spacing:1px;">Ulasan Jujur</h6>
            <h2 class="display-6 fw-black">Testimoni Murid {{ config('app.name') }}</h2>
        </div>

        <div class="marquee-wrapper">
            <div class="marquee-track">
                @php
                    $testis = [
                        ['Fitria Dewi S.', 'Ibunda Murid', '“Yang saya suka, gurunya milenial dan interaktif. Kami bisa request materi tambahan seperti sirah nabi, kisah sahabat, sampai fiqih. Anak jadi tidak cepat bosan.”'], 
                        ['Mita Sri Nuhriyani', 'Murid ' . config('app.name'), '"Alhamdulillah bisa ketemu ' . config('app.name') . ', anak2 sy bisa belajar ngaji online, dengan waktu yg flexible. pengajar juga cocok dgn anak2 sy."'], 
                        ['Yany Purnamasari', 'Murid ' . config('app.name'), '"Recommended, fast response, metode pembelajaran mudah dipahami dan pengajar sabar dan ramah. Sangat memudahkan kita yang ingin belajar mengaji."'], 
                        ['Tiza Asterinadewi', 'Murid ' . config('app.name'), '"Yang ingin bisa membaca Al-Qur’an namun terkendala tempat atau waktu, disini solusinya. adminnya fast response, pengajarnya masya ALLOH"'], 
                        ['Wydhia Astuti', 'Murid ' . config('app.name'), '"Gurunya milenial dan kita bisa request disisipi siroh nabi & fiqih. Sehingga anak tdk bosan dan ilmu yg didapat juga lebih banyak dan bermanfaat."']
                    ];
                @endphp
                {{-- Double the array for seamless scrolling --}}
                @foreach (array_merge($testis, $testis) as [$name, $title, $review])
                    <div class="testi-card d-flex flex-column text-start">
                        <div class="d-flex align-items-center gap-1 mb-3">
                            @for ($i = 0; $i < 5; $i++) <i class="fa-solid fa-star text-warning fs-14"></i> @endfor
                        </div>
                        <p class="fs-15 text-muted flex-grow-1 mb-4" style="line-height:1.6; font-style:italic;">{{ $review }}</p>
                        <div class="d-flex align-items-center gap-3 mt-auto">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white fs-16"
                                style="width:48px;height:48px;background:var(--premium-primary);">
                                {{ mb_substr($name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $name }}</h6>
                                <p class="text-muted fs-12 mb-0">{{ $title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── FAQ ───────────────────────────────────────────────────────────── --}}
    <section class="py-5" id="faq">
        <div class="container-xl py-4 text-center">
            <h6 class="fw-bold" style="color:var(--premium-secondary); text-transform:uppercase; letter-spacing:1px;">Tanya Jawab</h6>
            <h2 class="display-6 fw-black mb-5">Pertanyaan Seputar {{ config('app.name') }}</h2>
            
            <div class="row justify-content-center text-start reveal-up">
                <div class="col-lg-8">
                    <div class="accordion faq-accordion" id="faqAccordion">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Pakai metode apa saja disini ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted pt-0 px-4 pb-4">
                                    Kami menggunakan beragam metode untuk pembelajaran Al-Quran: Ummi, Tilawati, Qiroati, Yanbua, dan Iqra. Anda bebas memilih yang paling nyaman.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Perbedaan dari metode-metode yang ada apa ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted pt-0 px-4 pb-4">
                                    <p class="mb-2"><strong>1. Ummi:</strong> Menekankan bacaan tartil dengan tajwid sejak awal & standar jelas.</p>
                                    <p class="mb-2"><strong>2. Tilawati:</strong> Menggunakan pola bacaan terstruktur (nada) agar panjang-pendek akurat.</p>
                                    <p class="mb-2"><strong>3. Qiroati:</strong> Sangat fokus pada ketepatan bacaan; tidak naik tingkat sebelum benar sempurna.</p>
                                    <p class="mb-2"><strong>4. Yanbu’a:</strong> Selain membaca, murid dilatih menulis Arab & makhraj huruf (khas Kudus).</p>
                                    <p class="mb-0"><strong>5. Iqra:</strong> Paling umum, belajar bertahap dari pengenalan huruf tunggal hingga lancar.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Durasi per pertemuan berapa lama?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted pt-0 px-4 pb-4">
                                    Durasi belajarnya 60 menit per-sesi. Sudah mencakup penjelasan materi, latihan baca, koreksi bacaan dan tanya jawab dengan Ustadz/Ustadzah.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── CTA FOOTER ────────────────────────────────────────────────────────── --}}
    <section class="py-5 mb-4">
        <div class="container-xl">
            <div class="cta-banner text-center text-white reveal-scale">
                <div class="cta-circle" style="width:400px; height:400px; top:-200px; left:-100px;"></div>
                <div class="cta-circle" style="width:300px; height:300px; bottom:-150px; right:-50px;"></div>
                
                <div class="position-relative z-1">
                    <h2 class="display-4 fw-black mb-3 text-white">Mulai Langkah Berkahmu</h2>
                    <p class="fs-18 mb-5 mx-auto text-white-50" style="max-width: 600px;">
                        Jangan tunda lagi. Mari belajar mengaji dan memahami Al-Quran bersama {{ config('app.name') }} sekarang juga!
                    </p>
                    <a href="https://wa.me/628123456789" class="btn btn-light text-success btn-lg px-5 py-3 fw-bold shadow-lg d-inline-flex align-items-center justify-content-center gap-2" style="border-radius:100px; font-size:1.1rem; transition: background-color 0.2s;">
                        <i class="fa-brands fa-whatsapp fs-4 shrink-0 size-5"></i> Konsultasi & Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new Typed('#typewriter', {
                    strings: ['Dimana Saja', 'Kapan Saja', 'Lebih Fleksibel', 'Dari Rumah'],
                    typeSpeed: 60,
                    backSpeed: 40,
                    backDelay: 4500,
                    loop: true,
                    cursorChar: '|',
                    autoInsertCss: true
                });
            });
        </script>
    </x-slot>
</x-layouts.landing>


