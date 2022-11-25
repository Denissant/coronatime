@props(['center' => false])

<a href="{{ route('dashboard.home') }}">
    <img src="{{ asset('assets/logo-blue.svg') }}" alt="Coronatime Logo" class="w-fit @if($center) sm:mx-auto @endif">
</a>
