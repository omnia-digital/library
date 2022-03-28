@props(['value'])

<p {{ $attributes->merge(['class' => 'mt-2 text-sm text-color-base']) }}>
    {{ $value ?? $slot }}
</p>
