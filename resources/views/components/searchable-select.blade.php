@props(['name', 'id' => null, 'placeholder' => 'Pilih...', 'required' => false])

@php
    $id = $id ?? $name;
@endphp

<select name="{{ $name }}" id="{{ $id }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => 'form-select tom-select-init']) }}>
    @if($placeholder)
        <option value="" {{ $required ? 'disabled' : '' }} selected>{{ $placeholder }}</option>
    @endif
    {{ $slot }}
</select>

@once
    @push('styles')
    <link href="{{ asset('assets/css/tom-select.bootstrap5.min.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="{{ asset('assets/js/tom-select.complete.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tom-select-init').forEach(function(el) {
                if (!el.tomselect) {
                    new TomSelect(el, {
                        create: false,
                    });
                }
            });
        });
    </script>
    @endpush
@endonce
