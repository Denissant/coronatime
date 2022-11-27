<x-base>
    <x-form.wrapper-background>
        <x-title :title="__('Welcome back')" :center="false" :description="__('Welcome back! Please enter your details')" />

            <x-form.standard-form action_url="{{ route('login') }}">
                <x-form.input name="username" :label="__('Username')" :placeholder="__('Enter username or email')" />
                <x-form.input name="password" :label="__('Password')" :placeholder="__('Enter your password')" type="password" />

                <div class="flex items-center justify-between">
                    <x-form.remember />
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-brand-blue hover:underline">{{ __('Forgot password?') }}</a>
                </div>

                <x-form.button>{{ __('Log In') }}</x-form.button>
            </x-form.standard-form>

            <x-form.suggestion :question="__('Don’t have and account?')" :link_text="__('Sign up for free')" url="{{ route('register') }}" />

    </x-form.wrapper-background>
</x-base>
