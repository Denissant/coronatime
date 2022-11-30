<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_page_is_accessible()
	{
		$response = $this->get(route('register'));
		$response->assertSuccessful();
		$response->assertSee(__('auth.register_welcome'));
		$response->assertViewIs('auth.register');
	}

	public function test_can_register_with_valid_input_and_receive_confirmation_email()
	{
		Notification::fake();

		$user = User::firstWhere(['username' => 'myusername']);
		$this->assertNull($user);

		$response = $this->registerUser('myusername', 'mail@mail.com', 'pass', 'pass');

		$user = User::firstWhere(['username' => 'myusername']);
		$this->assertNotNull($user);
		$response->assertSessionDoesntHaveErrors();
		$response->assertRedirect(route('confirmation-splash'));

		Notification::assertSentTo($user, VerifyEmail::class);
	}

	public function test_all_fields_are_required_to_register()
	{
		Notification::fake();

		$response = $this->registerUser(null, null, null, null);

		$response->assertSessionHasErrors([
			'username' => __('validation.required', ['attribute' => 'username']),
			'email'    => __('validation.required', ['attribute' => 'email']),
			'password' => __('validation.required', ['attribute' => 'password']),
		]);
	}

	public function test_username_and_email_should_be_unique_to_register()
	{
		User::create(['username' => 'myusername', 'email' => 'mail@mail.com', 'password' => 'password']);

		$response = $this->registerUser('myusername', 'mail@mail.com', 'pass', 'pass');
		$response->assertSessionHasErrors([
			'username' => __('validation.unique', ['attribute' => 'username']),
			'email'    => __('validation.unique', ['attribute' => 'email']),
		]);
	}

	public function test_email_should_be_valid_to_register()
	{
		$response = $this->registerUser('myusername', 'MY_INVALID_EMAIL', 'pass', 'pass');
		$response->assertSessionHasErrors([
			'email'    => __('validation.email', ['attribute' => 'email']),
		]);
	}

	public function test_username_and_password_should_be_longer_than_two_characters_to_register()
	{
		$response = $this->registerUser('U', 'mail@mail.com', 'P', 'P');
		$response->assertSessionHasErrors([
			'username' => __('validation.min.string', ['attribute' => 'username', 'min' => 3]),
			'password' => __('validation.min.string', ['attribute' => 'password', 'min' => 3]),
		]);
	}

	public function test_passwords_should_match_to_register()
	{
		$response = $this->registerUser('myusername', 'mail@mail.com', 'mypassword', 'WRONG_PASSWORD_REPEAT');
		$response->assertSessionHasErrors([
			'password' => __('validation.confirmed', ['attribute' => 'password']),
		]);
	}

	public function test_verification_email_is_not_sent_if_register_input_is_invalid()
	{
		Notification::fake();
		$this->registerUser(null, null, null, null);
		Notification::assertNothingSent();
	}

	public function test_can_not_register_if_username_is_an_email()
	{
		$response = $this->registerUser('name@domain.com', 'mail@mail.com', 'pass', 'pass');
		$response->assertSessionHasErrors([
			'username'    => __('validation.not_email', ['attribute' => 'username']),
		]);
	}

	private function registerUser($username, $email, $password, $password_confirmation)
	{
		return $this->post(route('register'), [
			'username'              => $username,
			'email'                 => $email,
			'password'              => $password,
			'password_confirmation' => $password_confirmation,
		]);
	}
}
