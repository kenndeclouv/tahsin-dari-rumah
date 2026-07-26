<x-layouts.landing title="SyariHub - Belajar Mengaji Online untuk Anak & Dewasa">

    {{-- ─── HERO ──────────────────────────────────────────────────────────── --}}
    <section class="landing-hero" style="overflow:hidden; position:relative;">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>

        <div class="container-xl">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary mb-3 fs-12 px-3 py-2 fw-semibold">
                        <i class="ti ti-star me-1"></i> 1200+ Murid Belajar Bersama Kami
                    </span>
                    <h1 class="fw-black mb-3" style="font-size: clamp(2.4rem, 5vw, 3.6rem); line-height: 1.1;">
                        Belajar Mengaji Online Privat<br>
                        <span style="color: var(--bs-primary);">Dimana Saja dan Kapan Saja</span>
                    </h1>
                    <p class="text-muted fs-16 mb-4" style="max-width: 480px; line-height: 1.7;">
                        Kini belajar ngaji lebih mudah dan menyenangkan bersama SyariHub
                    </p>
                    <div class="d-flex gap-3 flex-wrap mb-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 fw-bold">
                                <i class="ti ti-dashboard me-2"></i> Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 fw-bold">
                                <i class="ti ti-player-play-filled me-2"></i> Belajar Sekarang
                            </a>
                        @endauth
                    </div>

                    {{-- Mini badges --}}
                    <div class="d-flex gap-3 flex-wrap">
                        @foreach ([['ti-users', '90+ Guru ngaji tersertifikasi'], ['ti-certificate', '2500+ Alumni belajar Al-Quran'], ['ti-thumb-up text-warning', '99% Rating kepuasan']] as [$icon, $label])
                            <div class="d-flex align-items-center gap-1 fs-12 text-muted">
                                <i class="ti {{ $icon }}"></i> {!! $label !!}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Hero visual --}}
                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <div class="position-relative" style="width: 420px;">
                        <div class="card shadow-lg"
                            style="border: 2px solid var(--bs-border-color); border-radius: 20px; overflow: hidden;">
                            <div class="card-body p-0">
                                <div
                                    style="height: 220px; background: linear-gradient(135deg, rgba(74,157,95,.15) 0%, rgba(74,157,95,.05) 100%); display:flex; align-items:center; justify-content:center; font-size: 80px; position:relative; overflow:hidden;">
                                    📖
                                </div>
                                <div class="p-4 text-center">
                                    <h5 class="fw-bold mb-2">Program Mengaji Privat</h5>
                                    <p class="text-muted fs-13 mb-3">Malu kalau belum bisa? Atau ingin lebih fokus? Private 1 on 1 aja bersama asatidz kami yang sabar dan profesional.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── KEUNGGULAN ───────────────────────────────────────────────────── --}}
    <section class="py-5" style="border-top: 2px solid var(--bs-border-color);" id="kenapa">
        <div class="container-xl py-3">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary mb-2">Alasan Mengapa mengaji di SyariHub</span>
                <h2 class="section-title mx-auto">Cocok buat kamu yang ingin lancar baca Al-Quran, anak-anak maupun dewasa</h2>
            </div>

            <div class="row g-4">
                @foreach ([
                    ['ti-user', 'primary', 'Belajarnya Private', 'Malu kalau belum bisa? atau ingin lebih fokus? Private 1 on 1 aja di SyariHub'], 
                    ['ti-clock', 'success', 'Jadwal Fleksibel', 'Anda bisa pilih jadwal sendiri, dari pagi sampai malam, weekdays atau weekend.'], 
                    ['ti-award', 'info', 'Sabar & Profesional', 'Kami sangat concern dengan kualitas pengajaran. Ustadz/ah di SyariHub adalah alumni kampus / pesantren ternama & sudah tersertifikasi.'], 
                    ['ti-book', 'warning', 'Bisa Request Materi', 'Mau belajar dari dasar, melancarkan, fokus makhraj & tajwid, hafalan, atau memahami makna ayat/surah - semua bisa di SyariHub, atau butuh materi lain ? hubungi kami untuk konsultasi.'],
                    ['ti-report-analytics', 'danger', 'Laporan per Pertemuan', 'Anda bisa pantau progress belajarnya melalui aplikasi, jadi bahan evaluasi & sekaligus penyemangat diri.'],
                    ['ti-arrows-exchange', 'primary', 'Bisa Request Ganti Ustadz/ah', 'Kurang cocok dengan cara mengajar ustadz / ustadzahnya? Boleh meminta ganti ustadz / ustadzah tanpa biaya tambahan apapun.']
                ] as [$icon, $color, $title, $desc])
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100 p-4 border rounded-3" style="border-color: var(--bs-border-color)!important">
                            <div class="feature-icon mb-3 d-inline-flex align-items-center justify-content-center rounded-3"
                                style="width:50px; height:50px; background: rgba(var(--bs-{{ $color }}-rgb),.12); color: var(--bs-{{ $color }}); font-size:24px;">
                                <i class="ti {{ $icon }}"></i>
                            </div>
                            <h5 class="fw-bold mb-2">{{ $title }}</h5>
                            <p class="text-muted fs-13 mb-0">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── UNDUH APP ─────────────────────────────────────────────────────── --}}
    <section class="py-5" style="border-top: 2px solid var(--bs-border-color); background: rgba(var(--bs-primary-rgb),.03);">
        <div class="container-xl py-3 text-center">
            <span class="badge bg-success-subtle text-success mb-2">Unduh</span>
            <h2 class="section-title mx-auto mb-3">Pantau progress belajarmu melalui aplikasi</h2>
            <p class="text-muted fs-15 mb-4">Sekarang pantau progress belajarmu semakin mudah</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="#" class="btn btn-dark btn-lg px-4 fw-bold rounded-pill">
                    <i class="ti ti-brand-google-play me-2 text-success"></i> Get It On Google Play
                </a>
                <a href="#" class="btn btn-dark btn-lg px-4 fw-bold rounded-pill">
                    <i class="ti ti-brand-apple me-2"></i> Get It On App Store
                </a>
            </div>
        </div>
    </section>

    {{-- ─── HARGA PAKET ──────────────────────────────────────────────────────── --}}
    <section class="py-5 bg-light" style="border-top: 2px solid var(--bs-border-color);" id="biaya">
        <div class="container-xl py-3">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary mb-2">Biaya</span>
                <h2 class="section-title mx-auto">Harga paket investasi belajar Al-Quran</h2>
                <p class="text-muted mt-2 mx-auto" style="max-width:520px;">Apapun paketnya tetap dibimbing oleh guru mengaji yang berkualitas</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ([
                    ['Paket 1', '300.000', '4x', '1x', 'primary'],
                    ['Paket 2', '600.000', '8x', '2x', 'success'],
                    ['Paket 3', '800.000', '12x', '3x', 'info'],
                    ['Paket 4', '1.300.000', '20x', 'Minimal 4x', 'warning']
                ] as [$nama, $harga, $pertemuan, $jadwal, $color])
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px;">
                            <div class="card-header bg-{{ $color }} text-white text-center py-4" style="border-radius: 20px 20px 0 0;">
                                <h4 class="mb-1 text-white">{{ $nama }}</h4>
                                <h2 class="fw-black mb-0">Rp {{ $harga }}</h2>
                            </div>
                            <div class="card-body p-4">
                                <ul class="list-unstyled mb-4 text-muted fs-14">
                                    <li class="mb-3 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> Guru Ngaji Bersertifikat</li>
                                    <li class="mb-3 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> Privat Satu Murid Satu Guru</li>
                                    <li class="mb-3 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> Free Materi Mengaji</li>
                                    <li class="mb-3 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> <strong>{{ $pertemuan }} Pertemuan</strong> Mengaji</li>
                                    <li class="mb-3 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> Jadwal <strong>{{ $jadwal }} Tiap Pekan</strong></li>
                                    <li class="mb-0 d-flex align-items-center"><i class="ti ti-check text-success me-2"></i> 60 Menit Per Sesi</li>
                                </ul>
                                <a href="https://wa.me/628123456789" class="btn btn-outline-{{ $color }} w-100 fw-bold">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── PENGAJAR ────────────────────────────────────────────────────────── --}}
    <section class="py-5" style="border-top: 2px solid var(--bs-border-color);">
        <div class="container-xl py-3">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary mb-2">Pengajar</span>
                <h2 class="section-title mx-auto">Pengajar Kami lulusan pesantren dan tentunya tersertifikasi</h2>
                <p class="text-muted mt-2 mx-auto">Berikut Almamater Pesantren Maupun Sertifikat Yang Dimiliki Pengajar Kami</p>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['Sertifikat Iqro', 'Pelopor cara cepat membaca Al-Quran oleh KH. As\'ad Humam', 'ti-book-2'],
                    ['Sertifikat BNSP', 'Lembaga resmi pemerintah untuk menjamin mutu dan kompetensi', 'ti-certificate'],
                    ['Sertifikat Ummi Foundation', 'Lembaga Pendidikan untuk peningkatan kualitas Guru Al-Qur\'an', 'ti-school'],
                    ['Sertifikat Pondok Al Karomah', 'Pondok yang fokus kepada hafalan, tafsir dan pembelajaran Al-Qur\'an', 'ti-building-mosque']
                ] as [$title, $desc, $icon])
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 p-4 border text-center shadow-sm" style="border-radius:15px; border-color: var(--bs-border-color)!important">
                            <i class="ti {{ $icon }} text-primary mb-3" style="font-size: 42px;"></i>
                            <h5 class="fw-bold">{{ $title }}</h5>
                            <p class="text-muted fs-13 mb-0">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── FAQ ───────────────────────────────────────────────────────────── --}}
    <section class="py-5" style="border-top: 2px solid var(--bs-border-color); background: rgba(var(--bs-primary-rgb),.02);" id="faq">
        <div class="container-xl py-3">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary mb-2">FAQ</span>
                <h2 class="section-title mx-auto">Pertanyaan Seputar SyariHub</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3 rounded shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Pakai metode apa saja disini ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Kami menggunakan beragam metode untuk pembelajaran Al-Quran :
                                    <ul class="mb-0 mt-2">
                                        <li>Ummi</li>
                                        <li>Tilawati</li>
                                        <li>Qiroati</li>
                                        <li>Yanbua</li>
                                        <li>Iqra</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 rounded shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Perbedaan dari metode-metode yang ada apa ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Masing-masing metode memiliki pendekatan yang berbeda-beda.<br><br>
                                    <strong>1. Ummi</strong><br> Menekankan bacaan Qur’an yang tartil dengan penerapan tajwid sejak awal serta sistem pengajaran yang terstandar.<br><br>
                                    <strong>2. Tilawati</strong><br> Membantu murid membaca Qur’an dengan pola bacaan yang terstruktur sehingga lebih mudah menjaga ketepatan panjang-pendek dan kelancaran bacaan.<br><br>
                                    <strong>3. Qiroati</strong><br> Fokus pada ketepatan bacaan; murid tidak naik tingkat sebelum bacaannya benar dan lancar.<br><br>
                                    <strong>4. Yanbu’a</strong><br> Selain membaca, murid juga dilatih menulis huruf Arab dan memperkuat ketepatan makhraj huruf.<br><br>
                                    <strong>5. Iqra</strong><br> Metode paling umum digunakan, belajar bertahap dari pengenalan huruf hingga lancar membaca Qur’an.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 rounded shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Durasi per pertemuan berapa lama?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Durasi belajarnya 60 menit per-sesi. Sudah mencakup penjelasan materi, latihan baca, koreksi bacaan dan tanya jawab dengan Ustadz/Ustadzah
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── TESTIMONI ─────────────────────────────────────────────────────────── --}}
    <section class="py-5" style="border-top: 2px solid var(--bs-border-color);" id="testimoni">
        <div class="container-xl py-3">
            <div class="text-center mb-5">
                <span class="badge bg-warning-subtle text-warning mb-2">⭐ Kata Mereka</span>
                <h2 class="section-title mx-auto">Testimoni Murid SyariHub</h2>
            </div>

            <div class="row g-4">
                @foreach ([
                    ['Fitria Dewi S.', 'Ibunda Murid', '“Yang saya suka, gurunya milenial dan interaktif. Kami bisa request materi tambahan seperti sirah nabi, kisah sahabat, sampai fiqih. Anak jadi tidak cepat bosan, dan ilmu yang didapat jauh lebih banyak serta benar-benar bermanfaat.”'], 
                    ['Mita Sri Nuhriyani', 'Murid SyariHub', '"Alhamdulillah bisa ketemu syarihub, anak2 sy bisa belajar ngaji online, dengan waktu yg flexible. pengajar juga cocok dgn anak2 sy, mudah2an anak2 sy bs mengaji dengan lancar dan lebih mengenal Islam. Terimakasih syarihub, terimakasih Kakak2 yg mengajarkan anak2 sy mengaji 🙏"'], 
                    ['Yany Purnamasari', 'Murid SyariHub', '"Recommended, fast response, metode pembelajaran mudah dipahami dan pengajar sabar dan ramah. Jadwal fleksible sesuai dengan permintaan, sangat memudahkan kita yang ingin belajar mengaji, bisa dimana saja dan kapan saja."'], 
                    ['Tiza Asterinadewi', 'Murid SyariHub', '"Yuukkk sahabat sahabat saya dimanapun berada, yang ingin bisa membaca Al-Qur’an namun terkendala tempat, transportasi, atau pun waktu nya, disini solusi nya, SYARIHUB, adminnya fast response dan ramah, pengajarnya, masya ALLOH"'], 
                    ['Wydhia Astuti', 'Murid SyariHub', '"Saya mendaftarkan anak saya belajar disini dan recommended karena gurunya milenial dan kita bisa request untuk disisipi siroh nabi/sahabat dan fiqih. Sehingga anak tdk bosan dan ilmu yg didapat juga lebih banyak dan bermanfaat."']
                ] as [$name, $title, $review])
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100"
                            style="border: 2px solid var(--bs-border-color); border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-1 mb-3">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="ti ti-star-filled text-warning fs-14"></i>
                                    @endfor
                                </div>
                                <p class="fs-13 text-muted mb-3" style="line-height:1.6;">{{ $review }}</p>
                                <div class="d-flex align-items-center gap-2 mt-auto">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white fs-14"
                                        style="width:36px;height:36px;background:var(--bs-primary);flex-shrink:0;">
                                        {{ mb_substr($name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="fw-semibold fs-13 mb-0">{{ $name }}</p>
                                        <p class="text-muted fs-11 mb-0">{{ $title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── CTA ────────────────────────────────────────────────────────────── --}}
    <section id="pesan" class="py-5" style="border-top: 2px solid var(--bs-border-color);">
        <div class="container-xl py-4">
            <div class="card text-center p-5"
                style="background: linear-gradient(135deg, var(--bs-primary) 0%, #1a6b3a 100%); border: none; color: #fff; border-radius: 20px; position:relative; overflow:hidden;">
                
                <div class="position-relative">
                    <div style="font-size:50px;margin-bottom:12px;">🕌</div>
                    <h2 class="fw-black mb-3" style="color: #fff; font-size: 2.2rem;">
                        Tertarik belajar bersama SyariHub?
                    </h2>
                    <p class="mb-4 fs-16" style="opacity:.85; max-width:500px; margin:0 auto 24px;">
                        Mulai langkah berkahmu dan mengaji bersama SyariHub!
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="https://wa.me/628123456789" class="btn btn-light btn-lg px-5 fw-bold">
                            <i class="ti ti-brand-whatsapp me-2"></i> Belajar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.landing>
