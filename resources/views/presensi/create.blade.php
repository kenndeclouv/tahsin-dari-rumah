<x-layouts.app title="Isi Presensi">
    <div class="max-w-4xl">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Isi Presensi Santri</h2>
            </div>
            
            <div class="p-6">
                <!-- Info Section -->
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Nama Santri</p>
                            <h3 class="text-base font-semibold text-gray-800">{{ $kelas->santri->nama }}</h3>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <p class="text-sm font-medium text-gray-500">Progres Pertemuan</p>
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-primary-100 text-primary-800">
                                    {{ $count + 1 }} / {{ $kelas->jumlah_pertemuan }}
                                </span>
                            </div>
                            <div class="flex w-full h-2.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuenow="{{ (($count + 1) / $kelas->jumlah_pertemuan) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-primary-600 text-xs text-white text-center whitespace-nowrap transition-all duration-500" style="width: {{ (($count + 1) / $kelas->jumlah_pertemuan) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('presensi.store', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">


                        <div>
                            <label class="block text-sm font-medium mb-2">Foto / Bukti Kehadiran</label>
                            
                            <input type="hidden" name="foto_base64" id="foto_base64">
                            
                            <div class="mb-3 space-y-3">
                                <!-- Camera Preview -->
                                <div id="camera-container" class="hidden relative w-full max-w-sm mx-auto overflow-hidden bg-black rounded-lg aspect-[3/4]">
                                    <video id="webcam" autoplay playsinline class="w-full h-full object-cover"></video>
                                    <canvas id="canvas" class="hidden"></canvas>
                                    <button type="button" id="btn-capture" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center justify-center size-14 bg-white rounded-full text-primary-600 shadow-lg hover:bg-gray-100 z-10 focus:outline-none focus:ring-4 focus:ring-primary-500">
                                        <i class="fa-solid fa-camera text-xl"></i>
                                    </button>
                                </div>
                                
                                <!-- Captured Image Preview -->
                                <div id="preview-container" class="hidden relative w-full max-w-sm mx-auto overflow-hidden rounded-lg shadow-sm border border-gray-200 aspect-[3/4]">
                                    <img id="photo-preview" class="w-full h-full object-cover" src="" alt="Captured Photo">
                                    <button type="button" id="btn-retake" class="absolute top-2 right-2 inline-flex items-center gap-x-1.5 py-1.5 px-2.5 rounded-md text-xs font-medium bg-red-100 text-red-800 shadow-sm hover:bg-red-200 z-10 focus:outline-none">
                                        <i class="fa-solid fa-rotate-left"></i> Ulangi
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="button" id="btn-open-camera" class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                    <i class="fa-solid fa-camera"></i> Buka Kamera
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Wajib foto langsung (real-time) sebagai bukti kehadiran.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Catatan Tambahan</label>
                            <textarea name="catatan" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Opsional..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-x-3">
                        <a href="{{ route('dashboard') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                            Batal
                        </a>
                        <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan Presensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnOpenCamera = document.getElementById('btn-open-camera');
            const cameraContainer = document.getElementById('camera-container');
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const btnCapture = document.getElementById('btn-capture');
            const previewContainer = document.getElementById('preview-container');
            const photoPreview = document.getElementById('photo-preview');
            const btnRetake = document.getElementById('btn-retake');
            const fotoBase64Input = document.getElementById('foto_base64');
            
            let stream = null;

            btnOpenCamera.addEventListener('click', async function() {
                try {
                    // Prefer front camera, fallback to any available camera
                    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: 'user' } } });
                    video.srcObject = stream;
                    
                    cameraContainer.classList.remove('hidden');
                    previewContainer.classList.add('hidden');
                    btnOpenCamera.classList.add('hidden');
                    
                    fotoBase64Input.value = ''; // clear base64
                } catch (err) {
                    console.error("Gagal membuka kamera:", err);
                    alert("Kamera tidak dapat diakses. Pastikan Anda memberikan izin akses kamera (allow camera) di browser Anda.");
                }
            });

            btnCapture.addEventListener('click', function() {
                // Set canvas size to match video
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                
                // Draw image to canvas
                const ctx = canvas.getContext('2d');
                
                // If facingMode is user (selfie), usually we mirror the canvas to match the preview
                // However, since we can't reliably detect if it's mirrored, we'll just draw it normally
                // (or keep mirror logic if preferred)
                // ctx.translate(canvas.width, 0);
                // ctx.scale(-1, 1);
                
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                // Convert to base64
                const dataUrl = canvas.toDataURL('image/png');
                fotoBase64Input.value = dataUrl;
                photoPreview.src = dataUrl;
                
                // Hide camera, show preview
                cameraContainer.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                
                // Stop camera stream
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });

            btnRetake.addEventListener('click', function() {
                fotoBase64Input.value = '';
                btnOpenCamera.click(); // trigger open camera again
            });
        });
    </script>
    @endpush
</x-layouts.app>
