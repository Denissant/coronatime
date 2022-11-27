<x-base>
    <x-form.wrapper-background>
        <x-title :title="__('Welcome to Coronatime')" :center="false" :description="__('Please enter required info to sign up')" />

        <x-form.standard-form action_url="{{ route('register') }}">

            <x-form.input name="username" :label="__('Username')" :placeholder="__('Enter unique username')" :hint="__('Username should be unique, min 3 symbols')" />
            <x-form.input name="email" :label="__('Email')" :placeholder="__('Enter your email')" type="email" />
            <x-form.input name="password" :label="__('Password')" :placeholder="__('Enter password')" type="password" />
            <x-form.input name="password_confirmation" :label="__('Repeat password')" :placeholder="__('Repeat password')" type="password" />

            <div class="flex items-center justify-between">
                <x-form.remember />
            </div>

            <x-form.button>{{ __('Sign Up') }}</x-form.button>
        </x-form.standard-form>

        <x-form.suggestion :question="__('Already have an account?')" :link_text="__('Log in')" url="{{ route('login') }}" />

    </x-form.wrapper-background>
</x-base>
