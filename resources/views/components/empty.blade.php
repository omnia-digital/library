@props([
    'padding' => 'p-12'
])

@php
    $class = 'relative block w-full border-2 border-gray-300 border-dashed rounded-lg text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary';
    $class .= ' ' . $padding;
@endphp

<button type="button" {{ $attributes->merge(['class' => $class]) }}>
    <svg class="mx-auto h-12 w-12 text-light-text-color" xmlns="http://www.w3.org/2000/svg" stroke="var(--text-light-text-color)" fill="none" viewBox="0 0 48 48" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6"/>
    </svg>
    <span class="mt-2 block text-sm font-medium text-dark-text-color">
        {{ $slot }}
    </span>
</button>
