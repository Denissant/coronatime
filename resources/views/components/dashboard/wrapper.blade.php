@props(['title'])

<x-base>
    @vite('resources/js/burger-menu.js')

    <main class="py-6 px-4 sm:pt-5 sm:px-12 lg:px-28">
        <header class="flex justify-between">
            <x-logo />
            <nav class="flex">
                <x-dashboard.lang-switch />
                <x-dashboard.burger-menu />
            </nav>
        </header>

        <section class="mt-12 sm:mt-16">
            <x-title title="{{ $title }}" :is_dashboard="true" />
            <div class="border-b border-brand-light">
                <x-dashboard.section-link href="{{ route('dashboard.home') }}">{{ __('dashboard.worldwide') }}</x-dashboard.section-link>
                <x-dashboard.section-link href="{{ route('dashboard.countries') }}">{{ __('dashboard.by_country') }}</x-dashboard.section-link>
            </div>
            {{ $slot }}
        </section>
    </main>
</x-base>

