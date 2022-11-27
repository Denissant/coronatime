<x-dashboard.wrapper :title="__('dashboard.worldwide_statistics')">
    <div class="flex flex-wrap justify-between sm:flex-nowrap sm:space-x-6">
        <x-dashboard.stat-figure index="1" :caption="__('dashboard.new_cases')" number="{{ $worldwideStats['confirmed'] }}"
                                 background_color_class="bg-[#EEEEFE]" text_color_class="text-brand-blue" graph_color="blue"/>
        <x-dashboard.stat-figure index="2" :caption="__('dashboard.recovered')" number="{{ $worldwideStats['recovered'] }}"
                                 background_color_class="bg-[#EAF8F1]" text_color_class="text-brand-lightgreen" graph_color="green"/>
        <x-dashboard.stat-figure index="3" :caption="__('dashboard.deaths')" number="{{ $worldwideStats['deaths'] }}"
                                 background_color_class="bg-[#FCFAEC]" text_color_class="text-brand-yellow" graph_color="yellow"/>
    </div>
    <x-dashboard.newsletter />
</x-dashboard.wrapper>
