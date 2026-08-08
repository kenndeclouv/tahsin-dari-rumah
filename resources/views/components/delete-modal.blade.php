<!-- Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 z-[80] hidden overflow-y-auto overflow-x-hidden bg-gray-900/50 backdrop-blur-sm transition-all" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="relative w-full max-w-lg p-6 bg-white rounded-2xl shadow-2xl text-left overflow-hidden transform transition-all">
            
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button type="button" onclick="closeDeleteModal()" class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <span class="sr-only">Close</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-bold text-gray-900" id="delete-modal-title">Konfirmasi Hapus</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="delete-modal-message">Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 sm:flex sm:flex-row-reverse gap-3">
                <button type="button" id="delete-modal-confirm-btn" class="inline-flex justify-center items-center gap-x-2 w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto">
                    Ya, Hapus Data
                </button>
                <button type="button" onclick="closeDeleteModal()" class="inline-flex justify-center items-center gap-x-2 w-full px-4 py-2.5 mt-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentDeleteForm = null;
    let isActionLink = false;

    function confirmDelete(element, message = null) {
        // Find the closest form if the element is not a form
        currentDeleteForm = element.tagName.toLowerCase() === 'form' ? element : element.closest('form');
        
        // If it's just a link without a form
        isActionLink = element.tagName.toLowerCase() === 'a' && !currentDeleteForm;

        if (!currentDeleteForm && !isActionLink) {
            currentDeleteForm = element; // Fallback
        }

        const modal = document.getElementById('delete-confirmation-modal');
        const messageEl = document.getElementById('delete-modal-message');
        
        if (message) {
            messageEl.innerText = message;
        } else {
            messageEl.innerText = "Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.";
        }
        
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-confirmation-modal').classList.add('hidden');
        currentDeleteForm = null;
    }

    document.getElementById('delete-modal-confirm-btn').addEventListener('click', function() {
        if (currentDeleteForm) {
            if (isActionLink) {
                // If it was a button without a form, trigger a hidden form submission? Or redirect if a href?
                // For this project, deletes are mostly inside forms, but let's handle if it's a link
                if(currentDeleteForm.href) {
                    window.location.href = currentDeleteForm.href;
                }
            } else {
                // Remove the onsubmit handler to prevent infinite loop if we resubmit
                currentDeleteForm.onsubmit = null; 
                currentDeleteForm.submit();
            }
        }
    });
</script>
