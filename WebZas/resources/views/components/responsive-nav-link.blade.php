@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-2.5 border-l-4 border-zas-light text-start text-sm font-semibold text-zas-light bg-zas-primaryHover focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-4 pe-4 py-2.5 border-l-4 border-transparent text-start text-sm font-medium text-zas-light/80 hover:text-zas-light hover:bg-zas-primaryHover hover:border-zas-light/50 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
