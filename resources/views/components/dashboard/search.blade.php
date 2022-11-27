<form class="relative" method="GET">
    <input type="hidden" name="sort" value="{{ request('sort') }}">
    <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
    <label for="search" class="sr-only">{{ __('Search countries') }}</label>
    <input id="search" name="search" placeholder="{{ __('Search by country') }}" type="text" value="{{ request('search') }}"
           class="h-12 border-0 sm:border sm:border-brand-light rounded-lg pl-7 sm:pl-14 pr-6 w-60 focus:border-brand-blue focus:outline-brand-lightblue focus:outline-3" />
    <div class="absolute h-5 w-5 bottom-3.5 sm:left-6"><x-assets.search /></div>
</form>
