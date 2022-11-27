@props(['name'])

@php
    $ascending = false;
    $descending = false;
    if (request('sort') === $name && request('sort_direction') === 'ASC') {
        $sort_url = request()->fullUrlWithQuery(['sort' => $name, 'sort_direction' => 'DESC']);
        $ascending = true;
    } else if (request('sort') === $name && request('sort_direction') === 'DESC') {
        $sort_url = request()->fullUrlWithQuery(['sort' => null, 'sort_direction' => null]);
        $descending = true;
    } else {
        $sort_url = request()->fullUrlWithQuery(['sort' => $name, 'sort_direction' => 'ASC']);
    }
@endphp

<th scope="col" {{ $attributes->merge(['class' => " w-1/4 pl-4 sm:pl-10 text-left text-sm font-semibold"]) }}>
    <a href="{{ $sort_url }}" class="flex items-center gap-1">
        {{ $slot }} <x-assets.sort :asc="$ascending" :desc="$descending" />
    </a>
</th>
