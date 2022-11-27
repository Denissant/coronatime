<div class="group relative my-auto" tabindex="0">
    <div class="flex mr-8 sm:mr-10 font-normal">{{ $current_locale }} <x-assets.dropdown-arrow /></div>
    <div role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
         class="invisible group-hover:visible group-focus-within:visible opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 scale-0 group-hover:scale-100 group-focus-within:scale-100
                absolute z-10 mt-2 w-36 sm:w-44 origin-top-left divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-2 ring-black ring-opacity-5 focus:outline-none transition-all duration-500">
        <x-dashboard.lang-item href="{{ route('language', 'en') }}">English</x-dashboard.lang-item>
        <x-dashboard.lang-item href="{{ route('language', 'ka') }}">ქართული</x-dashboard.lang-item>
    </div>
</div>
