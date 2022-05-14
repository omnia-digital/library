@props([
    'name' => 'tag',
    'bgColor' => 'neutral',
    'textColor' => 'base-text-color',
    'class' => '',
])

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-1 rounded-lg font-medium ' . 'bg-'.$bgColor .' '. 'text-'.$textColor .' '. $class]) }}>
  {{ $slot }}
</span>
