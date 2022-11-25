@props(['location', 'confirmed', 'deaths', 'recovered', 'last'])

@php $classes = 'w-1/4 pl-4 sm:pl-10 py-4 text-sm' @endphp

<tr class="w-full flex">
    <td class="{{ $classes }} @if($last) sm:rounded-bl-lg @endif">{{ $location }}</td>
    <td class="{{ $classes }}">{{ number_format($confirmed) }}</td>
    <td class="{{ $classes }}">{{ number_format($deaths) }}</td>
    <td class="{{ $classes }} @if($last) sm:rounded-br-lg @endif">{{ number_format($recovered) }}</td>
</tr>
