@props(['name', 'id' => null, 'placeholder' => 'Pilih...', 'required' => false])

@php
    $id = $id ?? $name;
@endphp

<select name="{{ $name }}" id="{{ $id }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => 'tom-select-init']) }}>
    @if($placeholder)
        <option value="" {{ $required ? 'disabled' : '' }} selected>{{ $placeholder }}</option>
    @endif
    {{ $slot }}
</select>

@once
    @push('styles')
    <link href="{{ asset('assets/css/tom-select.bootstrap5.min.css') }}" rel="stylesheet">
    <style>
        /* Overriding tom-select bootstrap variables to match tailwind/preline */
        .ts-control {
            border-radius: 0.5rem;
            border-color: #e5e7eb;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .ts-control.focus {
            border-color: #10b981;
            box-shadow: 0 0 0 1px #10b981;
        }
    </style>
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
