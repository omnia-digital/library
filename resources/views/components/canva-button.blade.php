@props([
    'size' => 'default',
    'designType' => 'A4Document',
    'theme' => 'default',
    'apiKey' => config('library.canva.button.api_key'),
    'text' => 'Design on Canva'
])

<span data-design-type="{{ $designType }}" data-button-size="{{ $size }}" data-button-theme="{{ $theme }}" data-api-key="{{ $apiKey }}"
      class="canva-design-button" style="display:none;">{{ $text }}
</span>

@once
    @push('scripts')
        <script>
            (function (c, a, n) {
                var w = c.createElement(a), s = c.getElementsByTagName(a)[0];
                w.src = n;
                s.parentNode.insertBefore(w, s);
            })(document, 'script', 'https://sdk.canva.com/designbutton/v2/api.js');
        </script>
    @endpush
@endonce
