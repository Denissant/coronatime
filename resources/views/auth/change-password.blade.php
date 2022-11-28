<x-base>
    @vite('resources/js/input-validation.js')

    <x-form.wrapper-center>
        <x-title :title="__('auth.reset')" :center="true" />

        <x-form.center-form action_url="{{ route('password.update') }}">
            <div class="space-y-6">
                <input type="hidden" name="token" value="{{ $token }}" />
                <input type="hidden" name="email" value="{{ request()->get('email') }}" />
                <x-form.input name="password" :label="__('auth.new_password')" :placeholder="__('auth.enter_new_password')" type="password" />
                <x-form.input name="password_confirmation" :label="__('auth.repeat_password')" :placeholder="__('Repeat password')" type="password" />
                <x-form.error name="token" />
                <x-form.error name="email" />
            </div>
            <x-form.button>{{ __('auth.reset') }}</x-form.button>
        </x-form.center-form>
    </x-form.wrapper-center>
</x-base>
