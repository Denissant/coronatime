@props(['worldwideStats', 'countries'])

<table class="block overflow-auto absolute left-0 max-h-[60vh] mt-6 sm:mt-10 sm:static sm:shadow-lg sm:rounded-lg min-w-full border-collapse">
    <thead class="sticky top-0 bg-[#F6F6F7] sm:rounded-lg flex">
        <tr class="h-14 sm:rounded-lg flex items-center w-full">
            <x-dashboard.table-column name="countries.name" class="sm:rounded-tl-lg">Location</x-dashboard.table-column>
            <x-dashboard.table-column name="statistics.confirmed">New Cases</x-dashboard.table-column>
            <x-dashboard.table-column name="statistics.deaths">Deaths</x-dashboard.table-column>
            <x-dashboard.table-column name="statistics.recovered" class="sm:rounded-tr-lg">Recovered</x-dashboard.table-column>
        </tr>
    </thead>
    <tbody class="divide-y divide-[#F6F6F7] flex flex-col w-full">
        <x-dashboard.table-row location="Worldwide" :confirmed="$worldwideStats['confirmed']"
                               :deaths="$worldwideStats['deaths']" :recovered="$worldwideStats['recovered']" :last="false"
        />

        @foreach($countries as $country)
            <x-dashboard.table-row :location="$country->name" :confirmed="$country->statistics->confirmed"
                       :deaths="$country->statistics->deaths" :recovered="$country->statistics->recovered" :last="$loop->last"
            />
        @endforeach
    </tbody>
</table>
