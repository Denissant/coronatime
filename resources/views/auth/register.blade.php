<x-base>
    <x-form.wrapper-background>
        <x-form.head title="Welcome to Coronatime" :center="false" description="Please enter required info to sign up" />

        <x-form.standard-form action_url="#">

            <x-form.input name="username" label="Username" placeholder="Enter unique username" hint="Username should be unique, min 3 symbols" />
            <x-form.input name="email" label="Email" placeholder="Enter your email" type="email" />
            <x-form.input name="password" label="Password" placeholder="Enter password" type="password" />
            <x-form.input name="repeat-password" label="Repeat password" placeholder="Repeat password" type="password" />

            <div class="flex items-center justify-between">
                <x-form.remember />
            </div>

            <x-form.button>Sign Up</x-form.button>
        </x-form.standard-form>

        <x-form.suggestion question="Already have an account?" link_text="Log in" url="{{ route('login') }}" />

    </x-form.wrapper-background>
</x-base>
