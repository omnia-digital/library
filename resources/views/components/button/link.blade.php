@props([
'href' => '#',
'primary' => false,
'size' => 'px-4 py-2'
])

@php
 $baseClasses = 'inline-flex items-center justify-center border text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100
 focus:ring-primary ';
    $class = $baseClasses . $primary
    ? $size . ' border-neutral-light text-dark-text-color bg-neutral hover:bg-neutral-light'
    : $size . ' border-transparent text- bg-secondary hover:bg-secondary-dark ';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
