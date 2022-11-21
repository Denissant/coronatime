@props(['action_url'])

<div class="w-full h-full mx-auto sm:w-full sm:h-auto sm:max-w-sm">
    <form class="space-y-6 flex flex-col min-h-full justify-between sm:min-h-0" action="{{ $action_url }}" method="POST">
        {{ $slot }}
    </form>
</div>