<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap"
        rel="stylesheet">

    <!-- FontAwesome 7.2.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/all.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --premium-primary: var(--primary-600);
            --premium-secondary: var(--primary-500);
            --premium-accent: #f59e0b;
            --premium-bg: #fdfbf7;
            --premium-surface: #ffffff;
            --premium-text: #0f172a;
            --premium-text-muted: #64748b;
            --radius-xl: 32px;
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        html,
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--premium-bg);
            color: var(--premium-text);
            overflow-x: hidden;
            scroll-behavior: auto;
            /* Disable native smooth — let GSAP take over */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            letter-spacing: -0.03em;
            color: var(--premium-text);
        }

        /* ─── GSAP Smooth Scroll Wrapper ─── */
        #smooth-wrapper {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        #smooth-content {
            will-change: transform;
        }

        /* ─── Cursor Follower ─── */
        .cursor-dot {
            position: fixed;
            width: 8px;
            height: 8px;
            background: var(--premium-primary);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width 0.15s, height 0.15s, opacity 0.15s;
        }

        .cursor-ring {
            position: fixed;
            width: 36px;
            height: 36px;
            border: 1.5px solid rgba(6, 78, 59, 0.4);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
        }

        body:hover .cursor-dot {
            opacity: 1;
        }

        /* ─── Navbar ─── */
        .landing-nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(253, 251, 247, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            border-radius: 100px;
            z-index: 1000;
            padding: 0.5rem 1.5rem;
            transition: all 0.4s ease;
        }

        .landing-nav.scrolled {
            top: 12px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }



        /* ─── GSAP Reveal Base States ─── */
        .reveal-up {
            opacity: 0;
            transform: translateY(60px);
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-60px);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(60px);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.9);
        }

        /* ─── Horizontal line reveal ─── */
        .line-draw {
            display: block;
            width: 0;
            height: 3px;
            background: var(--premium-secondary);
            border-radius: 2px;
            margin-top: 8px;
        }

        /* ─── Hero Gradient Text ─── */
        .hero-gradient-text {
            background: linear-gradient(120deg, var(--premium-secondary) 0%, var(--premium-primary) 60%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% auto;
        }

        /* ─── Bento Card hover with tilt ─── */
        .bento-card {
            transform-style: preserve-3d;
            transition: box-shadow 0.3s ease;
        }

        /* ─── Floating parallax shapes ─── */
        .parallax-blob {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(60px);
        }

        /* ─── Footer ─── */
        .landing-footer {
            padding: 4rem 0;
            background: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: 5rem;
        }

        /* ─── Layout Fixes ─── */
        .page-content {
            margin-left: 0 !important;
            width: 100%;
        }

        /* ─── Counter Number ─── */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }
    </style>

    {{ $head ?? '' }}
</head>

<body>
    <!-- Custom Cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    <!-- PRELOADER -->
    {{-- <x-preloader /> --}}

    <!-- Navbar: OUTSIDE smooth-wrapper so it stays fixed independently of GSAP -->
    <nav class="landing-nav flex items-center justify-between" id="landingNav">
        <div class="text-primary-600">
            <x-logo class="flex items-center gap-2" />
        </div>

        <div class="hidden md:flex items-center gap-1">
            <a href="#kenapa" class="nav-link">Keunggulan</a>
            <a href="#biaya" class="nav-link">Paket</a>
            <a href="#testimoni" class="nav-link">Testimoni</a>
            <a href="#faq" class="nav-link">FAQ</a>
            @auth
                <a href="{{ route('dashboard') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">Log In</a>
            @endauth
        </div>
    </nav>

    <!-- Page Content wrapped in SmoothSmoother -->
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <div class="page-content">
                {{ $slot }}
            </div>

            <footer class="bg-gray-50 border-t border-gray-200 pt-16 pb-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-16">
                        <div class="lg:col-span-2">
                            <x-logo class="mb-6 inline-flex" />
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 max-w-sm">
                                Platform belajar mengaji online dan offline terpercaya. Membantu Anda dan anak-anak lancar membaca Al-Quran dengan guru bersertifikat.
                            </p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-600 transition-colors">
                                    <i class="fa-brands fa-instagram text-lg"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-600 transition-colors">
                                    <i class="fa-brands fa-facebook-f text-lg"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-600 transition-colors">
                                    <i class="fa-brands fa-youtube text-lg"></i>
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-6">Program</h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Ngaji Private</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Ngaji Anak</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Tahsin Dewasa</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Bahasa Arab</a></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-6">Perusahaan</h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Tentang Kami</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Tim Pengajar</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Karir</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Kontak</a></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-6">Legal</h4>
                            <ul class="space-y-4">
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Syarat & Ketentuan</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-primary-600 text-sm transition-colors">Kebijakan Privasi</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-gray-400 text-sm mb-0">© {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.</p>
                        <div class="flex gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-full border border-transparent bg-primary-600 text-white hover:bg-primary-700 transition-colors">
                                    <i class="fa-solid fa-grid-2"></i> Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-full border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 transition-colors shadow-sm">
                                    <i class="fa-solid fa-right-to-bracket"></i> Masuk App
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </footer>


            <x-alert></x-alert>
            <!-- Scripts -->



            {{ $scripts ?? '' }}

            <!-- GSAP Premium Assets -->
            <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
            <script src="{{ asset('assets/js/scrollTrigger.min.js') }}"></script>
            <script src="{{ asset('assets/js/scrollSmoother.min.js') }}"></script>
            <script src="{{ asset('assets/js/observer.min.js') }}"></script>
            <script src="https://unpkg.com/split-type"></script>

            <script>
                gsap.registerPlugin(ScrollSmoother, ScrollTrigger, Observer, ScrollToPlugin);

                let smoother;
                // Don't init ScrollSmoother immediately if preloader is active, we do it after

                document.addEventListener('DOMContentLoaded', () => {
                    smoother = ScrollSmoother.create({
                        wrapper: '#smooth-wrapper',
                        content: '#smooth-content',
                        smooth: 1.5,
                        effects: true,
                    });

                    // Set Initial states for animations
                    gsap.set('.reveal-up', {
                        y: 60,
                        opacity: 0
                    });
                    gsap.set('.fade-up', {
                        y: 30,
                        opacity: 0
                    });
                    gsap.set('.reveal-left', {
                        x: -60,
                        opacity: 0
                    });
                    gsap.set('.reveal-right', {
                        x: 60,
                        opacity: 0
                    });
                    gsap.set('.reveal-scale', {
                        scale: 0.9,
                        opacity: 0
                    });

                    // Smooth scroll anchor links to avoid conflict with ScrollSmoother
                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                        anchor.addEventListener('click', function (e) {
                            const targetId = this.getAttribute('href');
                            if (targetId && targetId !== '#' && document.querySelector(targetId)) {
                                e.preventDefault();
                                if (smoother) {
                                    smoother.scrollTo(targetId, true, "top 40px");
                                }
                            }
                        });
                    });

                    // Fallback if preloader is commented out or missing
                    if (!document.getElementById('system-preloader') && typeof window.triggerHeroAnimations === 'function') {
                        setTimeout(() => {
                            window.triggerHeroAnimations();
                        }, 100);
                    }
                });

                // Global function to trigger hero animations (called from preloader)
                window.triggerHeroAnimations = function() {
                    // ScrollTrigger Animations
                    gsap.utils.toArray('.reveal-up').forEach(el => {
                        gsap.to(el, {
                            y: 0,
                            opacity: 1,
                            duration: 0.9,
                            ease: 'expo.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 85%',
                            }
                        });
                    });

                    gsap.utils.toArray('.fade-up').forEach(el => {
                        gsap.to(el, {
                            y: 0,
                            opacity: 1,
                            duration: 0.6,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 90%',
                            }
                        });
                    });

                    gsap.utils.toArray('.reveal-left').forEach(el => {
                        gsap.to(el, {
                            opacity: 1,
                            x: 0,
                            duration: 0.9,
                            ease: 'expo.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 85%'
                            }
                        });
                    });

                    gsap.utils.toArray('.reveal-right').forEach(el => {
                        gsap.to(el, {
                            opacity: 1,
                            x: 0,
                            duration: 0.9,
                            ease: 'expo.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 85%'
                            }
                        });
                    });

                    gsap.utils.toArray('.reveal-scale').forEach(el => {
                        gsap.to(el, {
                            opacity: 1,
                            scale: 1,
                            duration: 0.8,
                            ease: 'back.out(1.4)',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 90%'
                            }
                        });
                    });

                    gsap.utils.toArray('.line-draw').forEach(el => {
                        gsap.to(el, {
                            width: '48px',
                            duration: 0.8,
                            ease: 'expo.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 90%'
                            }
                        });
                    });
                };

                // Magnetic Button Effect
                document.addEventListener('DOMContentLoaded', () => {
                    const buttons = document.querySelectorAll('.btn, .btn-premium, .btn-premium-outline');
                    const strength = 0.4;

                    buttons.forEach(btn => {
                        btn.addEventListener("mousemove", (e) => {
                            const rect = btn.getBoundingClientRect();
                            const x = gsap.utils.mapRange(rect.left, rect.right, -rect.width / 2, rect
                                .width / 2, e.clientX);
                            const y = gsap.utils.mapRange(rect.top, rect.bottom, -rect.height / 2, rect
                                .height / 2, e.clientY);

                            gsap.to(btn, {
                                x: x * strength,
                                y: y * strength,
                                duration: 0.4,
                                ease: "power2.out",
                                overwrite: true
                            });
                        });

                        btn.addEventListener("mouseleave", () => {
                            gsap.to(btn, {
                                x: 0,
                                y: 0,
                                duration: 0.7,
                                ease: "elastic.out(1, 0.4)",
                                overwrite: true
                            });
                        });
                    });
                });

                // Custom Cursor Logic
                document.addEventListener('DOMContentLoaded', () => {
                    const cursorDot = document.querySelector('.cursor-dot');
                    const cursorRing = document.querySelector('.cursor-ring');
                    
                    if(cursorDot && cursorRing) {
                        gsap.set(cursorDot, { xPercent: -50, yPercent: -50 });
                        gsap.set(cursorRing, { xPercent: -50, yPercent: -50 });

                        let xTo = gsap.quickTo(cursorDot, "x", {duration: 0.1, ease: "power3"}),
                            yTo = gsap.quickTo(cursorDot, "y", {duration: 0.1, ease: "power3"}),
                            xToRing = gsap.quickTo(cursorRing, "x", {duration: 0.3, ease: "power3"}),
                            yToRing = gsap.quickTo(cursorRing, "y", {duration: 0.3, ease: "power3"});

                        window.addEventListener("mousemove", e => {
                            xTo(e.clientX);
                            yTo(e.clientY);
                            xToRing(e.clientX);
                            yToRing(e.clientY);
                        });
                        
                        // Hover effects on links/buttons
                        const interactables = document.querySelectorAll('a, button, .btn');
                        interactables.forEach(el => {
                            el.addEventListener('mouseenter', () => {
                                gsap.to(cursorRing, { width: 56, height: 56, borderColor: 'var(--premium-primary)', backgroundColor: 'rgba(6, 78, 59, 0.1)', duration: 0.3 });
                                gsap.to(cursorDot, { scale: 0, duration: 0.3 });
                            });
                            el.addEventListener('mouseleave', () => {
                                gsap.to(cursorRing, { width: 36, height: 36, borderColor: 'rgba(6, 78, 59, 0.4)', backgroundColor: 'transparent', duration: 0.3 });
                                gsap.to(cursorDot, { scale: 1, duration: 0.3 });
                            });
                        });
                    }
                });
            </script>
</body>

</html>
