<x-base>
    <x-form.wrapper-background>
        <x-form.head title="Welcome back" :center="false" description="Welcome back! Please enter your details" />

            <x-form.standard-form action_url="#">
                <x-form.input name="username" label="Username" placeholder="Enter username or email" />
                <x-form.input name="password" label="Password" placeholder="Enter your password" type="password" />

                <div class="flex items-center justify-between">
                    <x-form.remember />
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-brand-blue hover:underline">Forgot password?</a>
                </div>

                <x-form.button>Log In</x-form.button>
            </x-form.standard-form>

            <x-form.suggestion question="Don’t have and account?" link_text="Sign up for free" url="{{ route('register') }}" />

    </x-form.wrapper-background>
</x-base>
