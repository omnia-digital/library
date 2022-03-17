<div class="editor bg-white border border-gray-200 rounded-md shadow-sm">
    <div
        wire:ignore
        x-data="{content: @entangle($attributes->wire('model')),...tiptap()}"
    >
        <x-library::tiptap.menu/>

        <div x-ref="editorReference" {{ $attributes->whereDoesntStartWith('wire:model') }}></div>

        <div class="px-2 py-3 text-right text-gray-500 text-sm">
            Word Count: <span x-text="content?.replace(/(<([^>]+)>)/gi, '').trim().split(' ').filter(n => n !== '').length">0</span>
        </div>

        <!-- Modals -->
        <x-library::tiptap.link-modal/>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('/vendor/library/tiptap.js') }}"></script>
    @endpush
@endonce

