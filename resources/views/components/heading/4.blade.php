@props([
    'boldClass' => 'font-medium'
])

@php
    $class = 'text-base leading-6 text-color-dark ' . $boldClass;
@endphp

<h3 {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</h3>
