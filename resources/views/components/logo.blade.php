@props(['center' => false])

<a class="block sm:mx-auto sm:w-full sm:max-w-lg xl:max-w-full" href="{{ route('home') }}">
    <img src="{{ asset('assets/logo-blue.svg') }}" alt="Coronatime Logo" class="w-fit @if($center) sm:mx-auto @endif">
</a>
