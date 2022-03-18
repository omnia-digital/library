@props([
    'showWordCount' => true,
    'wordCountText' => 'Word Count',
    'wordCountType' => 'word', // word or character
    'characterLimit' => null,
    'heightClass' => 'min-h-[500px]',
])

<div class="editor bg-white border border-gray-200 rounded-md shadow-sm">
    <div
        wire:ignore
        x-data="{
            content: @entangle($attributes->wire('model')),
            wordCount: 0,
            wordCountType: '{{ $wordCountType }}',
            characterLimit: '{{ $characterLimit }}',
            heightClass: '{{ $heightClass }}',
            ...tiptap()
        }"
        x-init="() => {
            $watch('content', () => wordCount = wordCountType === 'word' ? editor().storage.characterCount.words() : editor().storage.characterCount.characters())
        }"
    >
        <x-library::tiptap.menu/>

        <div x-ref="editorReference" {{ $attributes->whereDoesntStartWith('wire:model') }}></div>

        @if ($showWordCount)
            <div class="px-2 py-3 text-right text-gray-500 text-sm">
                {{ $wordCountText }}: <span x-text="wordCount">0</span>
            </div>
        @endif

        <!-- Modals -->
        <x-library::tiptap.link-modal/>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('/vendor/library/tiptap.js') }}"></script>
    @endpush
@endonce
