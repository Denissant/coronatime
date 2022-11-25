<x-base>
    <x-form.wrapper-center>
        <x-title title="Reset Password" :center="true" />

        <x-form.center-form action_url="{{ route('password.update') }}">
            <div class="space-y-6">
                <input type="hidden" name="token" value="{{ $token }}" />
                <input type="hidden" name="email" value="{{ request()->get('email') }}" />
                <x-form.input name="password" label="New password" placeholder="Enter new password" type="password" />
                <x-form.input name="password_confirmation" label="Repeat password" placeholder="Repeat password" type="password" />
                <x-form.error name="token" />
                <x-form.error name="email" />
            </div>
            <x-form.button>Reset Password</x-form.button>
        </x-form.center-form>
    </x-form.wrapper-center>
</x-base>
