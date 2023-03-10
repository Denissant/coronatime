<x-base>
    <x-form.wrapper-center>

        <div class="mt-[25vh] sm:mt-[16vh]">
            <div class="mx-auto w-min mb-4">
                <x-assets.success />
            </div>
            <div class="font-normal w-2/3 mx-auto sm:w-full">{{ __('auth.confirmation_success') }}</div>
        </div>
        <a href="{{ route('login') }}" class="mx-auto mt-auto sm:mt-24 w-full sm:h-auto sm:max-w-sm">
            <x-form.button>{{ __('auth.sign_in') }}</x-form.button>
        </a>
    </x-form.wrapper-center>
</x-base>
