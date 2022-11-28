<x-base>
    @vite('resources/js/input-validation.js')

    <x-form.wrapper-background>
        <x-title :title="__('auth.register_welcome')" :center="false" :description="__('auth.register_welcome_description')" />

        <x-form.standard-form action_url="{{ route('register') }}">

            <x-form.input name="username" :label="__('auth.username')" :placeholder="__('auth.enter_unique_username')" :hint="__('auth.username_hint')" />
            <x-form.input name="email" :label="__('auth.email')" :placeholder="__('auth.enter_email')" type="email" />
            <x-form.input name="password" :label="__('auth.password')" :placeholder="__('auth.enter_password')" type="password" />
            <x-form.input name="password_confirmation" :label="__('auth.repeat_password')" :placeholder="__('Repeat password')" type="password" />

            <div class="flex items-center justify-between">
                <x-form.remember />
            </div>

            <x-form.button>{{ __('auth.sign_up') }}</x-form.button>
        </x-form.standard-form>

        <x-form.suggestion :question="__('auth.login_question')" :link_text="__('auth.login')" url="{{ route('login') }}" />

    </x-form.wrapper-background>
</x-base>
