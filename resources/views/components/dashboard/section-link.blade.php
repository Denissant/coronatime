@props(['href'])

<h4 class="inline mr-6 text-sm @if(Request::url() === $href) font-bold pb-3 border-b-[3px] border-brand-black @endif">
    <a href="{{ $href }}">{{ $slot }}</a>
</h4>
