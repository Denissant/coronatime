<x-base>
    <x-form.wrapper-center>
        <x-form.head title="Reset Password" :center="true" />

        <x-form.center-form action_url="#">
            <div class="space-y-6">
                <x-form.input name="password" label="New password" placeholder="Enter new password" type="password" />
                <x-form.input name="repeat-password" label="Repeat password" placeholder="Repeat password" type="password" />
            </div>
            <x-form.button>Reset Password</x-form.button>
        </x-form.center-form>
    </x-form.wrapper-center>
</x-base>
