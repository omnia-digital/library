@props([
    'mode' => 'single', // Supports: single, multiple, range
    'format' => 'Y-m-d'
])

<div
    x-data="{
        value: @entangle($attributes->wire('model')),
        init() {
            let picker = flatpickr(this.$refs.picker, {
                mode: '{{ $mode }}',
                dateFormat: '{{ $format }}',
                defaultDate: this.value,
                placeholder: '12',
                onChange: (date, dateString) => {
                    let mode = '{{ $mode }}';

                    if (mode === 'single') {
                        this.value = dateString;
                    } else if(mode === 'multiple') {
                        this.value = dateString.split(', ')
                    } else if (mode === 'range') {
                        this.value = dateString.split(' to ')
                    }
                }
            })

            this.$watch('value', () => picker.setDate(this.value))
        },
    }"
>
    <input class="w-full" x-ref="picker" type="text" wire:ignore>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
@endonce
