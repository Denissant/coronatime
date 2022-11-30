<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
	use RefreshDatabase;

	public function test_forgot_password_page_is_accessible()
	{
		$response = $this->get(route('password.request'));
		$response->assertSuccessful();
		$response->assertSee(__('auth.reset'));
		$response->assertViewIs('auth.forgot');
	}

	public function test_can_receive_password_reset_link_with_valid_input()
	{
		Notification::fake();

		$email = 'mail@mail.com';
		$user = $this->createUser('name', $email, 'pass');

		$response = $this->post(route('password.email'), [
			'email' => $email,
		]);

		$response->assertSessionHasNoErrors();
		$response->assertRedirect(route('confirmation-splash'));

		Notification::assertSentTo($user, ResetPasswordNotification::class);
	}

	public function test_email_should_be_valid_to_receive_password_reset_link()
	{
		Notification::fake();

		$this->createUser('name', 'mail@mail.com', 'pass');
		$response = $this->post(route('password.email'), [
			'email' => 'WRONG_MAIL@mail.com',
		]);

		$response->assertSessionHasErrors([
			'email' => __('passwords.user'),
		]);

		Notification::assertNothingSent();
	}

	public function test_email_is_required_to_receive_password_reset_link()
	{
		$response = $this->post(route('password.email'), [
			'email' => null,
		]);

		$response->assertSessionHasErrors([
			'email' => __('validation.required', ['attribute' => 'email']),
		]);
	}

	public function test_reset_password_notification_does_not_throw_any_errors()
	{
		$exception = null;
		try
		{
			$email = 'mail@mail.com';
			$user = $this->createUser('name', $email, 'pass');
			$notification = new ResetPasswordNotification($this->getToken($user), $email);
			$user->notify($notification);
		}
		catch (Exception $exception)
		{
		}
		$this->assertNull($exception);
	}

	private function createUser($username, $email, $password): User
	{
		$user = User::create([
			'username' => $username,
			'email'    => $email,
			'password' => $password,
		]);
		$user->save();
		return $user;
	}

	private function getToken($user): string
	{
		return Password::broker('users')->createToken($user);
	}
}
