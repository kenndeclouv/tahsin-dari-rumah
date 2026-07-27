<x-layouts.landing>
    <x-slot:head>
        <title>Kebijakan Privasi - {{ config('app.name') }}</title>
    </x-slot>

    <div class="pt-32 pb-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-8 text-gray-900">Kebijakan Privasi</h1>
        
        <div class="prose prose-lg text-gray-600 max-w-none">
            <p class="mb-4">Terakhir diperbarui: {{ date('d F Y') }}</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">1. Pengumpulan Data</h2>
            <p class="mb-4">Kami di {{ config('app.name') }} sangat menghargai privasi Anda. Kami hanya mengumpulkan informasi pribadi yang Anda berikan secara langsung kepada kami saat mendaftar atau berkonsultasi, seperti nama, alamat email, dan nomor telepon.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">2. Penggunaan Informasi</h2>
            <p class="mb-4">Data yang dikumpulkan digunakan semata-mata untuk:</p>
            <ul class="list-disc pl-6 mb-4 space-y-2">
                <li>Mengelola jadwal dan sesi belajar Anda bersama asatidz kami.</li>
                <li>Menghubungi Anda terkait kelas dan informasi penting.</li>
                <li>Meningkatkan kualitas layanan operasional kami.</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">3. Perlindungan Data</h2>
            <p class="mb-4">Kami menerapkan standar keamanan yang wajar untuk melindungi informasi Anda dari akses yang tidak sah, penyalahgunaan, atau pengungkapan kepada pihak ketiga yang tidak berkepentingan.</p>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">4. Pihak Ketiga</h2>
            <p class="mb-4">Kami tidak akan menjual, menyewakan, atau menukar data pribadi Anda dengan pihak ketiga mana pun tanpa persetujuan Anda, kecuali jika sangat diwajibkan oleh hukum yang berlaku.</p>
        </div>
        
        <div class="mt-12">
            <a href="{{ route('landing') }}" class="text-primary-600 font-bold hover:underline"><i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda</a>
        </div>
    </div>
</x-layouts.landing>
