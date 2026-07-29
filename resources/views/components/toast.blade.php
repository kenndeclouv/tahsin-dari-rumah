@php
    $hasAlert = false;
    $type = 'info';
    $message = '';
    $title = '';

    if (session('success')) {
        $hasAlert = true;
        $type = 'success';
        $title = 'Berhasil!';
        $message = session('success');
    } elseif (session('error')) {
        $hasAlert = true;
        $type = 'error';
        $title = 'Error!';
        $message = session('error');
    } elseif (session('warning')) {
        $hasAlert = true;
        $type = 'warning';
        $title = 'Peringatan!';
        $message = session('warning');
    } elseif (session('info')) {
        $hasAlert = true;
        $type = 'info';
        $title = 'Informasi';
        $message = session('info');
    } elseif ($errors->any()) {
        $hasAlert = true;
        $type = 'error';
        $title = 'Terdapat Kesalahan';
        $message = '<ul class="list-disc pl-4 space-y-1">';
        foreach ($errors->all() as $error) {
            $message .= '<li>' . $error . '</li>';
        }
        $message .= '</ul>';
    }
@endphp

@if ($hasAlert)
<div id="toast-container" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-3 transition-all duration-300 transform translate-y-0 opacity-100">
    <!-- Toast -->
    <div class="max-w-xs w-full bg-white border border-gray-200 rounded-xl shadow-lg" role="alert" tabindex="-1">
        <div class="flex gap-3 p-4">
            @if($type == 'success')
                <svg class="shrink-0 size-5 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            @elseif($type == 'error')
                <svg class="shrink-0 size-5 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            @elseif($type == 'warning')
                <svg class="shrink-0 size-5 text-yellow-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            @else
                <svg class="shrink-0 size-5 text-blue-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </svg>
            @endif
            
            <div class="grow">
                <p class="text-sm font-semibold text-gray-800">
                    {{ $title }}
                </p>
                <div class="mt-1 text-sm text-gray-600">
                    {!! $message !!}
                </div>
            </div>
            <div class="ms-auto">
                <button type="button" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100" aria-label="Close" onclick="closeToast()">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
    <!-- End Toast -->
</div>

<script>
    function closeToast() {
        const toast = document.getElementById('toast-container');
        if(toast) {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }
    }

    // Auto close after 5 seconds
    setTimeout(closeToast, 5000);
</script>
@endif
