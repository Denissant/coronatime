@props(['name', 'hint' => ''])

@error($name)
<p class="text-brand-red text-sm mt-2 flex items-center gap-2">
    <img src="{{ asset('assets/error.png') }}" alt="" />
    {{ $message }}
</p>
@enderror

@if ($hint && !$errors->has($name))
<p class="text-sm mt-1 text-brand-gray">{{ $hint }}</p>
@endif
