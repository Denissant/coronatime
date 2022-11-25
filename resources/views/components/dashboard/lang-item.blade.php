@props(['href'])

<a href="{{ $href }}" role="menuitem" tabindex="0"
   class="block px-4 py-2 rounded-md hover:bg-brand-lightgreen hover:text-white focus:bg-brand-lightgreen focus:text-white">
    {{ $slot }}
</a>
