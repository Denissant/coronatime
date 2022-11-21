@props(['title' => '', 'description' => '', 'center'])

<div class="mb-6 sm:mx-auto sm:w-full sm:max-w-lg xl:max-w-full">
    @if ('$title')
        <h2 class="mt-10 text-xl font-black lg:mt-14">{{ $title }}</h2>
    @endif

    @if ('$description')
        <p class="mt-1 text-brand-gray font-normal lg:mt-3">
            {{ $description }}
        </p>
    @endif
</div>
