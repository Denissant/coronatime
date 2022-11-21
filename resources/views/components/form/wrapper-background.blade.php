<div class="grid h-full justify-center lg:grid-cols-2 2xl:justify-items-center">
    <div class="flex justify-start min-h-full flex-col py-6 px-4 w-screen lg:max-w-sm lg:ml-28 lg:py-10 lg:px-0 xl:max-w-2xl 2xl:max-w-xl">
        <x-logo />
        {{ $slot }}
    </div>
    <div class="justify-self-end h-full hidden lg:block">
        <img class="h-full" src="{{ asset('assets/vaccine-background.png') }}" alt=""/>
    </div>
</div>
