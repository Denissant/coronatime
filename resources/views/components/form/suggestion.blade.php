@props(['question', 'link_text', 'url'])

<div class="mt-6 mb-14 text-sm text-center mx-auto sm:max-w-lg lg:max-w-sm lg:mx-0">
    <span class="font-normal text-brand-gray"> {{ $question }} </span>
    <a href="{{ $url }}" class="font-bold"> {{ $link_text }} </a>
</div>
