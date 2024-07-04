@props(['active'])

@php
$classes = ($active ?? false)
            ? 'dropdown-item d-flex align-items-center'
            : 'dropdown-item d-flex align-items-center';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="bi bi-person"></i>{{ $slot }}
</a>
