@props([
    'class'
])

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-1 rounded-lg font-medium ' . $class]) }}>
  {{ $slot }}
</span>
