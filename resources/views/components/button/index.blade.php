<button wire:loading.attr="disabled"
        wire:loading.class.remove="bg-primary-600 hover:bg-primary-700 focus:ring-blue-500"
        wire:loading.class="bg-gray-500 cursor-not-allowed"
        {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500']) }}
>
    <div>
        <span wire:loading {{ $attributes->only('wire:target') }}>Loading...</span>
        <span wire:loading.remove {{ $attributes->only('wire:target') }}>{{ $slot ?? 'Submit' }}</span>
    </div>
</button>
