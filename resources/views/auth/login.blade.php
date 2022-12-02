<x-base>
    <x-form.wrapper-background>
        <x-title :title="__('auth.login_welcome')" :center="false" :description="__('auth.login_welcome_description')" />

            <x-form.standard-form action_url="{{ route('login.authenticate') }}">
                <x-form.input name="username" :label="__('auth.username')" :placeholder="__('auth.enter_username')" />
                <x-form.input name="password" :label="__('auth.password')" :placeholder="__('auth.enter_password')" type="password" />

                <div class="flex items-center justify-between">
                    <x-form.remember />
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-brand-blue hover:underline">{{ __('auth.forgot_question') }}</a>
                </div>

                <x-form.button>{{ __('auth.login') }}</x-form.button>
            </x-form.standard-form>

            <x-form.suggestion :question="__('auth.register_question')" :link_text="__('auth.register_suggestion')" url="{{ route('register') }}" />

    </x-form.wrapper-background>
</x-base>
