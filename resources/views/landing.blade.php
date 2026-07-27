<x-layouts.landing title="{{ config('app.name') }} - Belajar Mengaji Online untuk Anak & Dewasa">
    <x-slot name="head">
        <style>

            .hero-mesh {
                position: absolute;
                top: -20%;
                left: 50%;
                transform: translateX(-50%);
                width: 100vw;
                height: 1000px;
                background: 
                    radial-gradient(circle at 20% 30%, rgba(24, 110, 165, 0.2) 0%, transparent 40%),
                    radial-gradient(circle at 80% 40%, rgba(49, 148, 194, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 50% 10%, rgba(139, 201, 229, 0.05) 0%, transparent 50%);
                z-index: 0;
                pointer-events: none;
            }

            /* --- Marquee --- */
            .hero-marquee-container {
                position: absolute;
                bottom: 0px;
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
                color: white;
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


        </style>
    </x-slot>

    {{-- ─── HERO ──────────────────────────────────────────────────────────── --}}
    <section class="text-center pt-28 pb-16 md:pt-36 md:pb-24 relative overflow-visible">
        <div class="hero-mesh"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mb-20">
            
            <h1 class="mt-12 pt-2 hero-h1 text-4xl md:text-5xl lg:text-6xl font-bold mb-4 mx-auto leading-tight" style="max-width: 900px;">
                Belajar Mengaji Online/Offline <br>
                <span class="hero-gradient-text" id="typewriter"></span>
            </h1>
            
            <p class="hero-subtitle text-lg mb-8 mx-auto text-gray-500 leading-relaxed" style="max-width: 600px;">
                Kini belajar ngaji lebih mudah dan menyenangkan bersama asatidz {{ config('app.name') }} yang sabar dan profesional.
            </p>
            
            <div class="hero-cta flex flex-col sm:flex-row justify-center items-center gap-3 mb-12">
                <a href="https://wa.me/628123456789" class="btn-magnetic py-3 px-6 inline-flex items-center justify-center gap-x-2 text-base font-semibold rounded-full border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none shadow-md shadow-primary-600/20 w-full sm:w-auto">
                    <i class="fa-solid fa-play text-sm"></i> Belajar Sekarang
                </a>
                <a href="#biaya" class="btn-magnetic py-3 px-6 inline-flex items-center justify-center gap-x-2 text-base font-semibold rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none w-full sm:w-auto">
                    Lihat Pilihan Paket
                </a>
            </div>
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
    <section class="py-20" id="kenapa">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal-up">
                <h6 class="font-bold uppercase tracking-wider" style="color:var(--premium-secondary);">Mengapa {{ config('app.name') }}?</h6>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Cocok buat kamu yang ingin lancar<br>baca Al-Quran, anak-anak maupun dewasa</h2>
                <span class="line-draw mx-auto"></span>
            </div>

            <div class="bento-grid">
                
                {{-- 1. Private --}}
                <div class="bento-card bento-large relative overflow-hidden reveal-scale" style="background:var(--premium-primary); color:white;">
                    {{-- <div class="absolute -right-12 -bottom-12 text-[200px] opacity-10 leading-none">👤</div> --}}
                    <div class="bento-icon-wrapper" style="background:rgba(255,255,255,0.15); color:white;">
                        <i class="fa-solid fa-user-check text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-3 text-white text-2xl">Belajarnya Private 1 on 1</h3>
                    <p class="text-base mb-0 opacity-90 max-w-md">Malu kalau belum bisa? Atau ingin lebih fokus? Private 1 on 1 aja di {{ config('app.name') }}. Anda mendapat perhatian penuh dari pengajar.</p>
                </div>

                {{-- 2. Jadwal Fleksibel --}}
                <div class="bento-card reveal-up" style="transition-delay:0.1s">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-secondary) 15%, transparent); color:var(--premium-secondary);">
                        <i class="fa-solid fa-clock text-2xl"></i>
                    </div>
                    <h4 class="font-bold mb-3 text-xl">Jadwal Fleksibel</h4>
                    <p class="text-gray-500 mb-0">Pilih jadwal sendiri, dari pagi sampai malam, weekdays atau weekend bebas atur waktu luang Anda.</p>
                </div>

                {{-- 3. Sabar & Profesional --}}
                <div class="bento-card reveal-up" style="transition-delay:0.2s">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-primary) 12%, transparent); color:var(--premium-primary);">
                        <i class="fa-solid fa-award text-2xl"></i>
                    </div>
                    <h4 class="font-bold mb-3 text-xl">Sabar & Profesional</h4>
                    <p class="text-gray-500 mb-0">Alumni kampus/pesantren ternama & sudah tersertifikasi. Kami concern dengan kualitas pengajaran.</p>
                </div>

                {{-- 4. Bisa Request Materi --}}
                <div class="bento-card bento-large relative overflow-hidden reveal-scale" style="background:var(--premium-primary); color:white;">
                    {{-- <div class="absolute -right-12 -bottom-12 text-[200px] opacity-10 leading-none">📚</div> --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 items-center h-full relative z-10">
                        <div class="md:col-span-8">
                            <div class="bento-icon-wrapper" style="background:rgba(255,255,255,0.15); color:white;">
                                <i class="fa-solid fa-book text-2xl"></i>
                            </div>
                            <h4 class="font-bold mb-3 text-white text-xl">Bisa Request Materi Bebas</h4>
                            <p class="mb-0 opacity-90">Mulai dasar, makhraj, tajwid, hafalan, fiqih, sirah nabi, atau memahami makna ayat - semua bisa di {{ config('app.name') }} sesuai request.</p>
                        </div>
                    </div>
                </div>

                {{-- 5. Laporan & Evaluasi --}}
                {{-- <div class="bento-card">
                    <div class="bento-icon-wrapper" style="background:color-mix(in srgb, var(--premium-primary) 12%, transparent); color:var(--premium-primary);">
                        <i class="fa-solid fa-chart-line text-2xl"></i>
                    </div>
                    <h4 class="font-bold mb-3 text-xl">Laporan per Pertemuan</h4>
                    <p class="text-gray-500 mb-0">Pantau progress belajarnya melalui aplikasi, jadi bahan evaluasi & sekaligus penyemangat diri.</p>
                </div> --}}

            </div>
        </div>
    </section>

    {{-- ─── HARGA PAKET ──────────────────────────────────────────────────────── --}}
    <section class="py-20" id="biaya">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="text-center mb-16 reveal-up">
                <h6 class="font-bold uppercase tracking-wider" style="color:var(--premium-secondary);">Biaya Fleksibel</h6>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Harga paket investasi belajar Al-Quran</h2>
                <p class="text-gray-500 mt-3 mx-auto max-w-lg">Apapun paketnya, kualitas tetap yang utama dengan guru bersertifikat.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 items-center justify-center stagger-parent mt-8">
                @php
                    $pakets = [
                        ['Paket 1', '300', '4x', '1x', false],
                        ['Paket 2', '600', '8x', '2x', false],
                        ['Paket 3', '800', '12x', '3x', true],
                        ['Paket 4', '1.300', '20x', 'Minimal 4x', false]
                    ];
                @endphp

                @foreach ($pakets as [$nama, $harga, $pertemuan, $jadwal, $isFeatured])
                    <div class="relative group h-full {{ $isFeatured ? 'lg:-mt-6 lg:mb-6 z-10' : 'z-0' }}">
                        <!-- Glowing effect behind the featured card -->
                        @if($isFeatured)
                            <div class="absolute inset-0 bg-primary-600/20 blur-2xl rounded-[32px] group-hover:bg-primary-600/30 transition-all duration-500"></div>
                        @endif
                        
                        <div class="relative h-full flex flex-col bg-white border {{ $isFeatured ? 'border-primary-500 shadow-xl shadow-primary-600/10' : 'border-gray-100 shadow-sm' }} rounded-[32px] p-8 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                            
                            @if($isFeatured)
                                <!-- Top Ribbon / Highlight -->
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 bg-gradient-to-r from-primary-500 to-primary-700 text-white text-[10px] sm:text-xs font-bold px-4 py-1.5 rounded-b-xl shadow-sm tracking-wider">
                                    TERPOPULER
                                </div>
                            @endif
                            
                            <div class="mb-6 {{ $isFeatured ? 'mt-3' : '' }}">
                                <h5 class="font-semibold text-gray-500 mb-2">{{ $nama }}</h5>
                                <div class="flex items-baseline text-gray-900">
                                    <span class="text-xl md:text-2xl font-bold mr-1">Rp</span>
                                    <span class="text-4xl md:text-5xl font-black tracking-tight">{{ $harga }}</span>
                                    <span class="text-gray-500 font-medium ml-1">.000</span>
                                </div>
                            </div>
                            
                            <div class="flex-grow">
                                <ul class="space-y-4 mb-8 text-gray-600 text-sm md:text-base">
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full {{ $isFeatured ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-400' }} mr-3 mt-0.5">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </span>
                                        <span><strong>{{ $pertemuan }} Pertemuan</strong> Mengaji</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full {{ $isFeatured ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-400' }} mr-3 mt-0.5">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </span>
                                        <span>Jadwal <strong>{{ $jadwal }} Tiap Pekan</strong></span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full {{ $isFeatured ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-400' }} mr-3 mt-0.5">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </span>
                                        <span>60 Menit Per Sesi</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full {{ $isFeatured ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-400' }} mr-3 mt-0.5">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </span>
                                        <span>Privat 1 Murid 1 Guru</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full {{ $isFeatured ? 'bg-primary-100 text-primary-600' : 'bg-gray-100 text-gray-400' }} mr-3 mt-0.5">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </span>
                                        <span>Free Materi & Evaluasi</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <a href="https://wa.me/628123456789" class="btn-magnetic w-full py-3.5 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-full border {{ $isFeatured ? 'border-transparent bg-primary-600 text-white hover:bg-primary-700 shadow-lg shadow-primary-600/20' : 'border-gray-200 bg-white text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                                Pilih Paket Ini
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── PENGAJAR & SERTIFIKASI ────────────────────────────────────────────── --}}
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Background Blobs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-primary-200/40 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-200/30 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center gap-12 lg:gap-16">
                
                <div class="lg:col-span-5">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 shadow-sm text-sm font-bold text-primary-600 mb-6">
                        <i class="fa-solid fa-award text-amber-500"></i> Kualitas Pengajar
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-gray-900 leading-tight">Pengajar tersertifikasi & lulusan pesantren.</h2>
                    <p class="text-gray-500 text-lg mb-8 leading-relaxed">Kami memastikan setiap guru di {{ config('app.name') }} memiliki kapabilitas dan standar mutu yang diakui oleh lembaga pendidikan nasional maupun yayasan metode baca Al-Quran ternama.</p>
                    
                    <div class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm inline-flex">
                        <div class="flex -space-x-3">
                            <img class="w-12 h-12 rounded-full border-2 border-white object-cover bg-gray-100" src="https://ui-avatars.com/api/?name=Ustadz+A&background=random" alt="Guru 1">
                            <img class="w-12 h-12 rounded-full border-2 border-white object-cover bg-gray-100" src="https://ui-avatars.com/api/?name=Ustadzah+B&background=random" alt="Guru 2">
                            <img class="w-12 h-12 rounded-full border-2 border-white object-cover bg-gray-100" src="https://ui-avatars.com/api/?name=Ustadz+C&background=random" alt="Guru 3">
                        </div>
                        <div class="text-sm">
                            <p class="text-gray-900 font-bold mb-0">100+ Pengajar</p>
                            <p class="text-gray-500 mb-0">Siap membimbing Anda</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 mt-10 lg:mt-0">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach ([
                            ['Iqro', 'Pelopor metode cepat membaca Al-Quran oleh KH. As\'ad Humam.', 'fa-book-quran'],
                            ['BNSP', 'Lembaga resmi pemerintah untuk menjamin mutu dan kompetensi.', 'fa-certificate'],
                            ['Ummi Foundation', 'Standar pendidikan untuk peningkatan kualitas Guru Al-Qur\'an.', 'fa-school'],
                            ['Pondok Al Karomah', 'Fokus pada hafalan, tafsir dan pembelajaran Al-Qur\'an.', 'fa-mosque']
                        ] as [$title, $desc, $icon])
                            <div class="group p-8 rounded-[32px] bg-white border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                                <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center mb-6 text-primary-600 group-hover:bg-primary-600 group-hover:text-white group-hover:rotate-6 transition-all duration-300">
                                    <i class="fa-solid {{ $icon }} text-2xl"></i>
                                </div>
                                <h5 class="font-bold mb-3 text-xl text-gray-900">{{ $title }}</h5>
                                <p class="text-gray-500 leading-relaxed text-sm md:text-base">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .marquee-wrapper {
            overflow: hidden;
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            background: rgba(249, 250, 251, 0.5);
            padding: 2rem 0;
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
    </style>
    {{-- ─── TESTIMONI MARQUEE ─────────────────────────────────────────────────── --}}
    <section class="py-20 overflow-hidden" id="testimoni">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
            <h6 class="font-bold uppercase tracking-wider" style="color:var(--premium-secondary);">Ulasan Jujur</h6>
            <h2 class="text-3xl md:text-4xl font-bold mt-3">Testimoni Murid {{ config('app.name') }}</h2>
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
                    <div class="w-[300px] md:w-[400px] bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 whitespace-normal flex flex-col text-left">
                        <div class="flex items-center gap-1 mb-4">
                            @for ($i = 0; $i < 5; $i++) <i class="fa-solid fa-star text-amber-400 text-sm"></i> @endfor
                        </div>
                        <p class="text-[15px] text-gray-500 flex-grow mb-6 leading-relaxed italic">{{ $review }}</p>
                        <div class="flex items-center gap-3 mt-auto">
                            <div class="rounded-full flex items-center justify-center font-bold text-white text-base w-12 h-12"
                                style="background:var(--premium-primary);">
                                {{ mb_substr($name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="font-bold mb-0 text-gray-900">{{ $name }}</h6>
                                <p class="text-gray-500 text-xs mb-0">{{ $title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── FAQ ───────────────────────────────────────────────────────────── --}}
    <section class="py-20" id="faq">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h6 class="font-bold uppercase tracking-wider" style="color:var(--premium-secondary);">Tanya Jawab</h6>
            <h2 class="text-3xl md:text-4xl font-bold mt-3 mb-12">Pertanyaan Seputar {{ config('app.name') }}</h2>
            
            <div class="max-w-3xl mx-auto text-left reveal-up">
                <div class="hs-accordion-group">
                    
                    <div class="hs-accordion active bg-white border border-gray-200 mb-4 rounded-xl shadow-sm" id="faq1">
                        <button class="hs-accordion-toggle hs-accordion-active:text-primary-600 hs-accordion-active:bg-primary-50 inline-flex items-center justify-between w-full font-bold text-start text-gray-800 py-5 px-6 hover:text-primary-600 rounded-xl transition-colors" aria-controls="faq1-content">
                            Pakai metode apa saja disini ?
                            <span class="hs-accordion-active:hidden block"><i class="fa-solid fa-plus"></i></span>
                            <span class="hs-accordion-active:block hidden"><i class="fa-solid fa-minus"></i></span>
                        </button>
                        <div id="faq1-content" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="faq1">
                            <div class="pb-5 px-6">
                                <p class="text-gray-600">
                                    Kami menggunakan beragam metode untuk pembelajaran Al-Quran: Ummi, Tilawati, Qiroati, Yanbua, dan Iqra. Anda bebas memilih yang paling nyaman.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="hs-accordion bg-white border border-gray-200 mb-4 rounded-xl shadow-sm" id="faq2">
                        <button class="hs-accordion-toggle hs-accordion-active:text-primary-600 hs-accordion-active:bg-primary-50 inline-flex items-center justify-between w-full font-bold text-start text-gray-800 py-5 px-6 hover:text-primary-600 rounded-xl transition-colors" aria-controls="faq2-content">
                            Perbedaan dari metode-metode yang ada apa ?
                            <span class="hs-accordion-active:hidden block"><i class="fa-solid fa-plus"></i></span>
                            <span class="hs-accordion-active:block hidden"><i class="fa-solid fa-minus"></i></span>
                        </button>
                        <div id="faq2-content" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="faq2">
                            <div class="pb-5 px-6 text-gray-600 space-y-2">
                                <p><strong>1. Ummi:</strong> Menekankan bacaan tartil dengan tajwid sejak awal & standar jelas.</p>
                                <p><strong>2. Tilawati:</strong> Menggunakan pola bacaan terstruktur (nada) agar panjang-pendek akurat.</p>
                                <p><strong>3. Qiroati:</strong> Sangat fokus pada ketepatan bacaan; tidak naik tingkat sebelum benar sempurna.</p>
                                <p><strong>4. Yanbu’a:</strong> Selain membaca, murid dilatih menulis Arab & makhraj huruf (khas Kudus).</p>
                                <p><strong>5. Iqra:</strong> Paling umum, belajar bertahap dari pengenalan huruf tunggal hingga lancar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="hs-accordion bg-white border border-gray-200 mb-4 rounded-xl shadow-sm" id="faq3">
                        <button class="hs-accordion-toggle hs-accordion-active:text-primary-600 hs-accordion-active:bg-primary-50 inline-flex items-center justify-between w-full font-bold text-start text-gray-800 py-5 px-6 hover:text-primary-600 rounded-xl transition-colors" aria-controls="faq3-content">
                            Durasi per pertemuan berapa lama?
                            <span class="hs-accordion-active:hidden block"><i class="fa-solid fa-plus"></i></span>
                            <span class="hs-accordion-active:block hidden"><i class="fa-solid fa-minus"></i></span>
                        </button>
                        <div id="faq3-content" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="faq3">
                            <div class="pb-5 px-6">
                                <p class="text-gray-600">
                                    Durasi belajarnya 60 menit per-sesi. Sudah mencakup penjelasan materi, latihan baca, koreksi bacaan dan tanya jawab dengan Ustadz/Ustadzah.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ─── CTA FOOTER ────────────────────────────────────────────────────────── --}}
    <section class="py-20 mb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primary-800 to-primary-600 rounded-[32px] px-8 py-10 md:py-12 relative overflow-hidden text-center text-white ">
                <div class="cta-circle" style="background-color: var(--primary-500); border-radius: 50%; position: absolute; width:400px; height:400px; top:-200px; left:-100px;"></div>
                <div class="cta-circle" style="background-color: var(--primary-500); border-radius: 50%; position: absolute; width:300px; height:300px; bottom:-150px; right:-50px;"></div>
                
                <div class="relative z-10">
                    <p class="text-4xl md:text-5xl font-bold text-white mb-6 ">Mulai Langkah Berkahmu</p>
                    <p class="text-lg mb-8 mx-auto text-white/80 max-w-2xl">
                        Jangan tunda lagi. Mari belajar mengaji dan memahami Al-Quran bersama {{ config('app.name') }} sekarang juga!
                    </p>
                    <a href="https://wa.me/628123456789" class="btn-magnetic py-4 px-8 inline-flex justify-center items-center gap-x-3 text-lg font-bold rounded-full border border-transparent bg-white text-green-600 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none shadow-lg">
                        <i class="fa-brands fa-whatsapp text-2xl"></i> Konsultasi & Daftar Sekarang
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


