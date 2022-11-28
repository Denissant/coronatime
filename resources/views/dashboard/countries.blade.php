<x-dashboard.wrapper :title="__('dashboard.statistics_by_country')">
    <div class="mt-6 sm:mt-8">
        <x-dashboard.search />
        <x-dashboard.table :worldwideStats="$worldwideStats" :countries="$countries" />
    </div>
</x-dashboard.wrapper>
