<x-base>
    <x-form.wrapper-center>
        <x-title title="Reset Password" :center="true" />

        <x-form.center-form action_url="{{ route('password.email') }}">
            <x-form.input name="email" label="Email" placeholder="Enter your email" type="email" />
            <x-form.button>Reset Password</x-form.button>
        </x-form.center-form>
    </x-form.wrapper-center>
</x-base>
