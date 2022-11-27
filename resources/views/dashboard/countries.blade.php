<x-dashboard.wrapper title="Statistics by country">
    <div class="mt-6 sm:mt-8">
        <x-dashboard.search />
        <x-dashboard.table :worldwideStats="$worldwideStats" :countries="$countries" />
    </div>
</x-dashboard.wrapper>
