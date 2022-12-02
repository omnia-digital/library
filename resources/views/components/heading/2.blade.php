@props([
    'textColor' => 'text-heading-default-color',
    'textSize' => 'text-2xl',
    'boldClass' => 'font-medium',
    'class'=>''
])

<x-heading.heading heading="h2"
                            :text-color="$textColor"
                            :text-size="$textSize"
                            :bold-class="$boldClass"
                            :class="$class"
>{{ $slot }}</x-heading.heading>
