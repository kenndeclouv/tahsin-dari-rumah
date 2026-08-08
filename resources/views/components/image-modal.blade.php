<div id="image-preview-modal" class="hidden fixed inset-0 z-[80] bg-gray-900/50 backdrop-blur-sm overflow-y-auto overflow-x-hidden flex items-center justify-center p-4">
    <div class="relative w-full max-w-3xl bg-white border border-gray-200 rounded-xl shadow-2xl flex flex-col pointer-events-auto">
        <!-- Close button (floating) -->
        <button type="button" onclick="closeImagePreview()" class="absolute -top-4 -right-4 size-10 inline-flex justify-center items-center gap-x-2 rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none z-10" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <svg class="shrink-0 size-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
        
        <!-- Image Container -->
        <div class="p-2 sm:p-4 rounded-xl overflow-hidden flex justify-center items-center min-h-[200px] max-h-[80vh]">
            <img id="image-preview-element" src="" alt="Preview" class="max-w-full max-h-[75vh] object-contain rounded-lg">
        </div>
    </div>
</div>

<script>
    function openImagePreview(url) {
        const modal = document.getElementById('image-preview-modal');
        const img = document.getElementById('image-preview-element');
        img.src = url;
        modal.classList.remove('hidden');
    }

    function closeImagePreview() {
        const modal = document.getElementById('image-preview-modal');
        modal.classList.add('hidden');
        setTimeout(() => {
            document.getElementById('image-preview-element').src = '';
        }, 300); // Clear image after animation if any
    }

    // Close on backdrop click
    document.getElementById('image-preview-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImagePreview();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('image-preview-modal').classList.contains('hidden')) {
            closeImagePreview();
        }
    });
</script>
