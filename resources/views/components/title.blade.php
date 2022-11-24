@props(['title' => '', 'description' => '', 'is_dashboard' => false])

<div class="mb-6 sm:mx-auto sm:w-full xl:max-w-full @if(!$is_dashboard) sm:max-w-lg @endif">
    @if ('$title')
        <h2 class="mt-10 text-xl font-black lg:mt-14">{{ $title }}</h2>
    @endif

    @if ('$description')
        <p class="mt-1 text-brand-gray font-normal lg:mt-3">
            {{ $description }}
        </p>
    @endif
</div>
