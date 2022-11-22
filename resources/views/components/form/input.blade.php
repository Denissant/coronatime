@props(['name', 'label', 'placeholder', 'type' => 'text', 'value' => '', 'autocomplete' => '', 'hint' => ''])

<div>
    <x-form.label name="{{ $name }}" label="{{ $label }}" />

    <div class="relative">
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
               required placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}"
               class="block w-full h-14 appearance-none rounded-md border border-brand-light px-6 py-5.5 placeholder-brand-gray shadow-sm focus:border-brand-blue focus:outline-brand-lightblue focus:outline-3 sm:text-sm">

        <img hidden class="absolute right-5.5 top-3.5 w-6 h-6" src="{{ asset('assets/success.svg') }}" alt="" />
    </div>

    <x-form.error name="{{ $name }}" hint="{{ $hint }}" />
</div>
