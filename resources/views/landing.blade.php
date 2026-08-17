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

    {{-- ─── METODE PEMBELAJARAN ────────────────────────────────────────────── --}}
    <section class="py-20 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal-up">
                <h6 class="font-bold uppercase tracking-wider" style="color:var(--premium-secondary);">Pilihan Kelas</h6>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Pilih metode belajar yang paling nyaman buat kamu</h2>
                <span class="line-draw mx-auto"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Online --}}
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                        <video src="{{ asset('assets/video/online.mp4') }}" class="w-full h-full object-cover" autoplay loop muted playsinline></video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-5 left-5 text-white">
                            <h3 class="font-bold text-2xl flex items-center gap-2 !text-white"><i class="fa-solid fa-globe text-primary-400"></i> Kelas Online</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-0">Belajar dari mana saja, lebih fleksibel atur jadwal tanpa harus keluar rumah. Bisa diakses di seluruh dunia, interaktif dan efektif via Zoom/Google Meet.</p>
                    </div>
                </div>

                {{-- Offline --}}
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                        <video src="{{ asset('assets/video/offline.mp4') }}" class="w-full h-full object-cover" autoplay loop muted playsinline></video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-5 left-5 text-white">
                            <h3 class="font-bold text-2xl flex items-center gap-2 !text-white"><i class="fa-solid fa-house text-primary-400"></i> Kelas Offline</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-0">Pengajar profesional kami siap datang langsung ke rumah Anda. Saat ini kelas offline tersedia khusus untuk wilayah <strong>Kota Malang</strong> dan <strong>Surabaya</strong>.</p>
                    </div>
                </div>

                {{-- Anak-anak --}}
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                        <video src="{{ asset('assets/video/anak-anak.mp4') }}" class="w-full h-full object-cover" autoplay loop muted playsinline></video>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-5 left-5 text-white">
                            <h3 class="font-bold text-2xl flex items-center gap-2 !text-white"><i class="fa-solid fa-child text-primary-400"></i> Kelas Anak</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-0">Metode belajar yang menyenangkan, interaktif, dan penuh kesabaran khusus anak-anak agar semangat belajar mengaji sedari dini.</p>
                    </div>
                </div>
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


