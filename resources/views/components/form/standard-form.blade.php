@props(['action_url'])

<div class="w-full mx-auto sm:w-full sm:max-w-lg lg:max-w-sm lg:mx-0">
    <form class="space-y-6 flex flex-col" action="{{ $action_url }}" method="POST" novalidate>
        @csrf
        {{ $slot }}
    </form>
</div>
