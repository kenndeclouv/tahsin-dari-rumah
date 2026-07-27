<x-layouts.landing>
    <x-slot:head>
        <title>Syarat & Ketentuan - {{ config('app.name') }}</title>
    </x-slot>

    <div class="pt-32 pb-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-8 text-gray-900">Syarat & Ketentuan</h1>
        
        <div class="prose prose-lg text-gray-600 max-w-none">
            <p class="mb-4">Terakhir diperbarui: {{ date('d F Y') }}</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Pendahuluan</h2>
            <p class="mb-4">Selamat datang di {{ config('app.name') }}. Dengan menggunakan layanan kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Layanan Kami</h2>
            <p class="mb-4">Kami menyediakan layanan bimbingan membaca Al-Quran (tahsin, tahfidz, dan dasar) secara daring maupun luring. Ketersediaan guru dan jadwal bergantung pada kesepakatan awal bersama.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Kewajiban Pengguna</h2>
            <ul class="list-disc pl-6 mb-4 space-y-2">
                <li>Memberikan data diri yang akurat saat pendaftaran.</li>
                <li>Hadir tepat waktu sesuai jadwal kelas yang telah disepakati.</li>
                <li>Menghormati pengajar dan menjaga etika islami selama sesi pembelajaran.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Pembayaran & Pengembalian Dana</h2>
            <p class="mb-4">Biaya pendaftaran dan paket belajar yang telah dibayarkan tidak dapat dikembalikan (non-refundable) kecuali terjadi pembatalan sepihak dari tim {{ config('app.name') }} sebelum kelas dimulai.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">5. Perubahan Aturan</h2>
            <p class="mb-4">Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu jika diperlukan. Segala perubahan akan diinformasikan melalui situs web ini atau kontak yang terdaftar.</p>
        </div>
        
        <div class="mt-12">
            <a href="{{ route('landing') }}" class="text-primary-600 font-bold hover:underline"><i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda</a>
        </div>
    </div>
</x-layouts.landing>
