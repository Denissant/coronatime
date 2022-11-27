<x-base>
    <x-form.wrapper-center>
        <x-title :title="__('auth.reset')" :center="true" />

        <x-form.center-form action_url="{{ route('password.email') }}">
            <x-form.input name="email" :label="__('auth.email')" placeholder="{{ __('auth.enter_email')}}" type="email" />
            <x-form.button>{{ __('auth.reset') }}</x-form.button>
        </x-form.center-form>
    </x-form.wrapper-center>
</x-base>
