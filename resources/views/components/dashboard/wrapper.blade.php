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
            <x-title title="Worldwide Statistics" :is_dashboard="true" />
            <x-dashboard.section-link href="{{ route('dashboard.home') }}">Worldwide</x-dashboard.section-link>
            <x-dashboard.section-link href="{{ route('dashboard.countries') }}">By Country</x-dashboard.section-link>
            {{ $slot }}
        </section>
    </main>
</x-base>

