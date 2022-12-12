@props([
'href' => '#',
'primary' => false,
'size' => 'px-4 py-2'
])

@php
    $class = $primary
    ? $size . ' inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-dark-text-color bg-neutral hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-primary'
    : $size . ' inline-flex items-center justify-center border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-text-color bg-primary hover:bg-primary-dark focus:outline-none
    focus:ring-2
    focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-primary';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
