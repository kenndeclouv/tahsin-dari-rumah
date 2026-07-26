<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

<script>
    function getSwalOptions(icon, title, text) {
        return {
            icon: icon,
            title: title,
            text: text,
            confirmButtonColor: 'var(--bs-primary)',
        };
    }
</script>

@if (session('success'))
    <script>
        Swal.fire(getSwalOptions('success', 'Berhasil!', @json(session('success'))));
    </script>
@elseif (session('error'))
    <script>
        Swal.fire(getSwalOptions('error', 'Yahh Error :(', @json(session('error'))));
    </script>
@endif
@if (session('info'))
    <script>
        Swal.fire(getSwalOptions('info', 'Informasi', @json(session('info'))));
    </script>
@endif
@if (session('warning'))
    <script>
        Swal.fire(getSwalOptions('warning', 'Peringatan!', @json(session('warning'))));
    </script>
@endif

@if ($errors->any())
    <script>
        const errorHtml = `
            <ul style="text-align: left; padding: 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;

        Swal.fire({
            ...getSwalOptions('error', 'Yahh Terjadi Kesalahan :(', ''),
            html: errorHtml,
        });
    </script>
@endif
