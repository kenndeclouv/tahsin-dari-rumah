<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Evaluasi Bulanan - {{ $kelas->santri->nama }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0fdf4; color: #0f172a; }
        .wa-card {
            background-color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
    </style>
</head>
<body class="min-h-screen py-10 px-4 sm:px-6 flex items-center justify-center">
    
    <div class="max-w-xl w-full mx-auto">
        
        <!-- Header Brand -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-primary-700">tahsindarirumah.id</h1>
            <p class="text-sm text-gray-500 mt-1">Laporan Evaluasi Bulanan Santri</p>
        </div>

        <div class="wa-card rounded-2xl border border-primary-100 overflow-hidden relative">
            
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-400 to-primary-600"></div>

            <div class="p-6 sm:p-8">
                
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-3">
                        <span>🖇️</span> Evaluasi Bulanan
                    </h2>
                    
                    <div class="space-y-2 text-gray-700">
                        <div class="flex items-start">
                            <span class="w-8 shrink-0">🧒</span> 
                            <div>
                                <span class="font-medium">Nama Ananda:</span> 
                                <span class="font-bold text-primary-700">{{ $kelas->santri->nama }}</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="w-8 shrink-0">📅</span> 
                            <div>
                                <span class="font-medium">Periode:</span> 
                                <span>{{ $kelas->evaluasi->created_at->translatedFormat('F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 text-gray-700">
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                            <span>✨</span> Capaian Selama 1 Bulan:
                        </h3>
                        <div class="pl-8 whitespace-pre-wrap leading-relaxed text-sm">{!! nl2br(e($kelas->evaluasi->perkembangan_bacaan)) !!}
{!! nl2br(e($kelas->evaluasi->makhraj)) !!}
{!! nl2br(e($kelas->evaluasi->tajwid)) !!}</div>
                    </div>

                    @if($kelas->evaluasi->catatan_pengajar)
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                            <span>📝</span> Catatan dari Ustadz/Ustadzah:
                        </h3>
                        <div class="pl-8 whitespace-pre-wrap leading-relaxed text-sm italic text-gray-600">{!! nl2br(e($kelas->evaluasi->catatan_pengajar)) !!}</div>
                    </div>
                    @endif

                    @if($kelas->evaluasi->saran_latihan)
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                            <span>🎯</span> Target Pembelajaran Berikutnya:
                        </h3>
                        <div class="pl-8 whitespace-pre-wrap leading-relaxed text-sm">{!! nl2br(e($kelas->evaluasi->saran_latihan)) !!}</div>
                    </div>
                    @endif

                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="font-medium text-gray-800">Barakallahu fiikum 🤍</p>
                    <p class="text-sm text-gray-500 mt-1">Semoga Allah mudahkan Ananda dalam belajar dan mencintai Al-Qur’an.</p>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 flex justify-center border-t border-gray-100">
                <button onclick="copyToClipboard()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 focus:outline-none transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                    Copy Text WA
                </button>
            </div>
        </div>
        
    </div>

    <!-- Hidden text block for exact WA copying -->
    <textarea id="waText" class="hidden absolute -left-[9999px]" aria-hidden="true">
🖇️Evaluasi Bulanan tahsindarirumah.id 

🧒 Nama Ananda: {{ $kelas->santri->nama }}
📅 Periode: {{ $kelas->evaluasi->created_at->translatedFormat('F Y') }}

✨ Capaian Selama 1 Bulan:
{{ $kelas->evaluasi->perkembangan_bacaan }}
{{ $kelas->evaluasi->makhraj }}
{{ $kelas->evaluasi->tajwid }}

📝 Catatan dari Ustadz/Ustadzah:
{{ $kelas->evaluasi->catatan_pengajar ?? '-' }}

🎯 Target Pembelajaran Berikutnya:
{{ $kelas->evaluasi->saran_latihan ?? '-' }}

Barakallahu fiikum 🤍
Semoga Allah mudahkan Ananda dalam belajar dan mencintai Al-Qur’an.</textarea>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("waText");
            copyText.style.display = "block";
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value).then(() => {
                alert("Teks berhasil disalin! Silakan paste di WhatsApp.");
            }).catch(err => {
                console.error('Failed to copy!', err);
                document.execCommand("copy");
                alert("Teks berhasil disalin! Silakan paste di WhatsApp.");
            });
            copyText.style.display = "none";
        }
    </script>
</body>
</html>
