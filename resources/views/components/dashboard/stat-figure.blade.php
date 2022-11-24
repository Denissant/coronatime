@props(['index', 'caption', 'number', 'background_color_class', 'text_color_class', 'graph_color'])

<figure class="flex mt-6 pt-6 pb-4 flex-col items-center rounded-2xl sm:w-auto sm:grow sm:mt-8 lg:pb-10 lg:pt-9
               @if($index === '1') w-full @else w-[47%] @endif
               hover:scale-105 transition-all duration-500 {{ $background_color_class }}"
>
    @if($graph_color === 'blue')
        <x-assets.graph-blue />
    @elseif($graph_color === 'green')
        <x-assets.graph-green />
    @elseif($graph_color === 'yellow')
        <x-assets.graph-yellow />
    @endif

    <figcaption class="font-medium mt-3 sm:text-lg lg:text-xl">{{ $caption }}</figcaption>
    <div class="{{ $text_color_class }} font-black text-2xl sm:text-3xl lg:text-4xl mt-3">{{ number_format($number) }}</div>
</figure>
