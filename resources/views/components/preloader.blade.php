<div id="system-preloader" style="
    position: fixed;
    inset: 0;
    z-index: 99999;
    background-color: var(--premium-primary, #064e3b);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    pointer-events: auto;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow: hidden;
">
    <!-- Faint Islamic Background Text -->
    <div style="
        position: absolute; 
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
        color: rgba(255,255,255,0.03); 
        font-size: clamp(100px, 15vw, 300px); 
        font-family: 'Amiri', serif; 
        pointer-events: none; 
        white-space: nowrap;
        user-select: none;
    ">
        بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم
    </div>

    <!-- Center Content -->
    <div class="preloader-content" style="text-align: center; position: relative; z-index: 1;">
        <!-- Animated Icon -->
        <div class="preloader-icon" style="font-size: 3.5rem; margin-bottom: 1rem; color: var(--premium-secondary, #34d399);">
            <i class="ti ti-book"></i>
        </div>
        
        <h2 style="font-weight: 800; letter-spacing: 2px; margin-bottom: 0.5rem; color: white;">
            {{ config('app.name') }}
        </h2>
        
        <div id="loader-log" style="font-size: 1rem; color: rgba(255,255,255,0.8); font-weight: 500; min-height: 24px;">
            Menyiapkan ruang belajar...
        </div>
        
        <!-- Elegant Progress Line -->
        <div style="width: 250px; height: 10px; background: rgba(255,255,255,0.1); margin: 2rem auto; border-radius: 10px; overflow: hidden; position: relative;">
            <div id="loader-progress" style="position: absolute; left: 0; top: 0; height: 100%; width: 0%; background: var(--premium-secondary, #34d399); border-radius: 10px; box-shadow: 0 0 10px var(--premium-secondary, #34d399);"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.body.style.overflow = 'hidden';

        const logs = [
            "Menyiapkan ruang belajar...",
            "Menata kelas Al-Quran...",
            "Insya Allah, siap dimulai."
        ];

        const logElement = document.getElementById('loader-log');
        const progressBar = document.getElementById('loader-progress');
        const preloader = document.getElementById('system-preloader');
        const preloaderContent = document.querySelector('.preloader-content');
        const preloaderIcon = document.querySelector('.preloader-icon');

        const tl = gsap.timeline();

        // Subtle icon float
        gsap.to(preloaderIcon, {
            y: -10,
            duration: 1.5,
            yoyo: true,
            repeat: -1,
            ease: "sine.inOut"
        });

        // 1. Text Animation
        let logIndex = 0;
        const logInterval = setInterval(() => {
            if (logIndex < logs.length) {
                gsap.to(logElement, {
                    opacity: 0,
                    duration: 0.2,
                    onComplete: () => {
                        logElement.innerText = logs[logIndex];
                        gsap.to(logElement, { opacity: 1, duration: 0.2 });
                        logIndex++;
                    }
                });
            }
        }, 600);

        // Progress Bar
        let counter = { val: 0 };
        tl.to(counter, {
            val: 100,
            duration: 2,
            ease: "power2.inOut",
            onUpdate: () => {
                if (progressBar) progressBar.style.width = counter.val + '%';
            },
            onComplete: () => {
                clearInterval(logInterval);
                logElement.innerText = "Bismillah...";
            }
        });

        // Wipe up background
        tl.to(preloader, {
            yPercent: -100,
            duration: 1,
            ease: "expo.inOut"
        });

        // Hide preloader container & enable scroll
        tl.set(preloader, {
            display: "none",
            onComplete: () => {
                document.body.style.overflow = '';
                
                // Trigger hero animations after loader is done
                if(window.triggerHeroAnimations) {
                    window.triggerHeroAnimations();
                }
            }
        });

        // Enable preloader on navigation (soft fade)
        document.addEventListener("click", (e) => {
            const link = e.target.closest('a');
            if (!link) return;

            const href = link.getAttribute('href');
            if (!href || href === '#' || href.startsWith('#') || link.getAttribute('target') === '_blank') return;
            if (href.startsWith('mailto:') || href.startsWith('tel:')) return;

            try {
                const targetUrl = new URL(link.href, window.location.origin);
                if (targetUrl.origin !== window.location.origin) return;
                if (targetUrl.pathname === window.location.pathname && targetUrl.search === window.location.search) return;

                e.preventDefault();

                document.body.style.overflow = 'hidden';
                preloader.style.display = "flex";
                preloader.style.transform = "translateY(100%)";
                logElement.innerText = "Berpindah halaman...";
                if (progressBar) progressBar.style.width = '0%';
                preloaderContent.style.opacity = 1;
                preloaderContent.style.transform = "translateY(0)";

                const outTl = gsap.timeline({
                    onComplete: () => {
                        window.location.href = href;
                    }
                });

                outTl.to(preloader, { yPercent: 0, duration: 0.8, ease: "expo.inOut" });

            } catch (err) {}
        });

        window.addEventListener("pageshow", (event) => {
            if (event.persisted && preloader) {
                preloader.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });
</script>
